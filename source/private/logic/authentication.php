<?php

require_once('private/logic/db.php');
require_once('private/logic/objects/user.php');

class Authentication
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    private function base64url_encode($data) {
        return str_replace(['+','/','='], ['-','_',''], base64_encode($data));
    }

    private function base64url_decode($data) {
        return base64_decode(str_replace(['-','_'], ['+','/'], $data));
    }

    private function writeJWT($payload)
    {
        // créer les headers du JWT
        $headers = ['alg'=>'RS256','typ'=>'JWT'];
        $headers_encoded = $this->base64url_encode(json_encode($headers));

        // ajouter l'expiration du token
        $payload = array_merge($payload, ['exp'=>time()+3600]);
        // on encode tout ça en base64
        $payload_encoded = $this->base64url_encode(json_encode($payload));

        // on signe le tout
        $key = file_get_contents('private/priv.pem');
        openssl_sign("$headers_encoded.$payload_encoded", $signature, $key, 'sha256WithRSAEncryption');
        $signature_encoded = $this->base64url_encode($signature);

        $token = "$headers_encoded.$payload_encoded.$signature_encoded";
        setcookie('jwt', $token, time() + 3600, '/', '', true, true);
    }

    private function readJWT()
    {
        // vérifier si le cookie existe
        if (!isset($_COOKIE['jwt'])) {
            return false;
        }

        // exploser le jwt
        list($headers_encoded, $payload_encoded, $signature_encoded) = explode('.', $_COOKIE['jwt']);

        // récupérer la clé
        $key = file_get_contents('private/pub.crt');
        // décoder les 3 parties
        $signature = $this->base64url_decode($signature_encoded);
        $headers = json_decode($this->base64url_decode($headers_encoded), true);
        $payload = json_decode($this->base64url_decode($payload_encoded), true);

        // vérifier la signature
        if (openssl_verify("$headers_encoded.$payload_encoded", $signature, $key, 'sha256WithRSAEncryption')) {
            return $payload;
        }
        return false;
    }

    public function requestCode($email)
    {
        // generate 6 digits code
        $code = rand(100000, 999999);

        // store it in the database
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('INSERT INTO otp (EMAIL, OTP, DATE_OTP) VALUES (:email, :code, NOW()) ON DUPLICATE KEY UPDATE OTP = :code, DATE_OTP = NOW()');

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':code', $code);

        $stmt->execute();

        return $code;
    }

    public function verify($email, $code)
    {
        // check if the code is correct
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM otp WHERE EMAIL = :email AND OTP = :code AND DATE_OTP > DATE_SUB(NOW(), INTERVAL 5 MINUTE)');

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':code', $code);

        $stmt->execute();

        $result = $stmt->fetch();
        if (!$result) {
            return -1;
        } else {
            // check if the user exists
            $stmt = $conn->prepare('SELECT * FROM user WHERE EMAIL = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();

            if (!$result) {
               return -2;
            } else {
                $this->writeJWT(['sub'=>$result['ID_USER'], 'email'=>$result['EMAIL'], 'role'=>$result['TYPE']]);
                return 0;
            }
        }
    }

    public function isLogged()
    {
        if ($this->readJWT()) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        setcookie('jwt', '', time() - 3600, '/', '', true, true);
    }

    public function getUser(bool $request)
    {
        $jwt = $this->readJWT();
        if ($jwt && $request) {
            $user_db = new USER_DB();
            return $user_db->get($jwt['sub']);
        } elseif ($jwt && !$request) {
            return new User(null, null, $jwt['email'], $jwt['role'], null, $jwt['sub']);
        } else {
            return false;
        }
    }

    public function checkAuthorization($required = [0,1,2])
    {
        $user = $this->getUser(false);
        if (!$user) {
            header('Location: /login');
            http_response_code(307);
            exit();
        }
        if (!in_array($user->getType(), $required)) {
            header('Location: /');
            http_response_code(307);
            exit();
        }
        return true;
    }
}