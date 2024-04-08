<?php
require_once('private/logic/db.php');
require_once('private/logic/objects/promotion.php');

class user implements JsonSerializable
{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $type;
    private $promotion;

    public function __construct($first_name, $last_name, $email, $type, $promotion, $id = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->type = $type;
        $this->promotion = $promotion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPromotion()
    {
        return $this->promotion;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'type' => $this->type,
            'promotion' => $this->promotion
        ];
    }
}

class USER_DB{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM user WHERE id_user = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $promotion_db = new PROMOTION_DB();
        $promotion = $promotion_db->get($user['ID_PROMOTION']);

        return new user($user['FIRST_NAME'], $user['LAST_NAME'], $user['EMAIL'], $user['TYPE'], $promotion, $user['ID_USER']);

    }

    public function getByEmail($email)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $promotion_db = new PROMOTION_DB();
        $promotion = $promotion_db->get($user['ID_PROMOTION']);

        return new user($user['FIRST_NAME'], $user['LAST_NAME'], $user['EMAIL'], $user['TYPE'], $promotion, $user['ID_USER']);
    }

    public function search($search, $type = [0,1,2], $limit = null, $offset = null)
    {
        $conn = $this->db->getConnection();
        $query = 'SELECT * FROM user WHERE (first_name LIKE :search OR last_name LIKE :search OR email LIKE :search)';
        if ($type) {
            // ici on peut pas trop utiliser une requête préparée donc on va vérifier
            // que $type est un array contenant uniquement 0, 1 ou 2...
            if ($type == 0 || $type == 1 || $type == 2) {
                $type = [$type];
            } else {
                $type = array_filter($type, function($t) {
                    return $t == 0 || $t == 1 || $t == 2;
                }); // on filtre l'array, merci chatgpt honnêtement sinon j'aurais fait une triple boucle :/
            }
            $query .= ' AND type IN (' . implode(',', $type) . ')';
        }
        if ($limit) {
            $query .= ' LIMIT :limit';
        }
        if ($offset) {
            $query .= ' OFFSET :offset';
        }
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':search', "%". $search . "%");
        $stmt->bindValue(':limit', $limit);
        $stmt->bindValue(':offset', $offset);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $promotion_db = new PROMOTION_DB();

        $result = [];
        foreach ($users as $user) {
            $promotion = $promotion_db->get($user['ID_PROMOTION']);
            $result[] = new user($user['FIRST_NAME'], $user['LAST_NAME'], $user['EMAIL'], $user['TYPE'], $promotion, $user['ID_USER']);
        }
        return $result;
    }

    public function save($user)
    {
        $promotion_db = new PROMOTION_DB();
        $promotion = $promotion_db->save($user->getPromotion());

        $conn = $this->db->getConnection();
        if ($user->getId()) {
            $id = $user->getId();
            $stmt = $conn->prepare('UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email, type = :type, id_promotion = :id_promotion WHERE id_user = :id');
            $stmt->bindValue(':id', $user->getId());
        } else {
            $stmt = $conn->prepare('INSERT INTO user (first_name, last_name, email, type, id_promotion) VALUES (:first_name, :last_name, :email, :type, :id_promotion);');
        }
        $stmt->bindValue(':first_name', $user->getFirstName());
        $stmt->bindValue(':last_name', $user->getLastName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':type', $user->getType());
        $stmt->bindValue(':id_promotion', $promotion->getId());
        $stmt->execute();
        return new user(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getType(),
            $promotion,
            $id ?? $conn->lastInsertId()
        );
    }

    public function delete($user)
    {
        if (!$user->getId()) {
            return;
        }

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('DELETE FROM user WHERE id_user = :id');
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
    }
}
