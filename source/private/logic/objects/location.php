<?php
require_once('private/logic/db.php');

class location implements JsonSerializable {
    private $id;
    private $name;
    private $street;
    private $city;
    private $zip_code;
    private $country;

    public function __construct($name, $street, $city, $zip_code, $country, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->street = $street;
        $this->city = $city;
        $this->zip_code = $zip_code;
        $this->country = $country;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getCity() {
        return $this->city;
    }

    public function getZipCode() {
        return $this->zip_code;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setZipCode($zip_code) {
        $this->zip_code = $zip_code;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'street' => $this->street,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'country' => $this->country
        ];
    }
}

class LOCATION_DB {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($id) {
        $query = 'SELECT * FROM location WHERE ID_LOCATION = :id';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new location($row['NAME'], $row['STREET'], $row['CITY'], $row['ZIP_CODE'], $row['COUNTRY'], $row['ID_LOCATION']);
    }

    public function search($name) {
        $query = 'SELECT * FROM location WHERE NAME LIKE :name';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindValue(':name', '%' . $name . '%');
        $stmt->execute();
        $locations = [];
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $locations[] = new location($row['NAME'], $row['STREET'], $row['CITY'], $row['ZIP_CODE'], $row['COUNTRY'], $row['ID_LOCATION']);
        }
        return $locations;
    }

    public function save(location $location) {
        $conn = $this->db->getConnection();
        if ($location->getId()){
            $id = $location->getId();
            $stmt = $conn->prepare('UPDATE location SET NAME = :name, STREET = :street, CITY = :city, ZIP_CODE = :zip_code, COUNTRY = :country WHERE ID_LOCATION = :id;');
            $stmt->bindValue(':id', $location->getId());
        } else {
            $stmt = $conn->prepare('INSERT INTO location (NAME, STREET, CITY, ZIP_CODE, COUNTRY) VALUES (:name, :street, :city, :zip_code, :country);');
        }
        $stmt->bindValue(':name', $location->getName());
        $stmt->bindValue(':street', $location->getStreet());
        $stmt->bindValue(':city', $location->getCity());
        $stmt->bindValue(':zip_code', $location->getZipCode());
        $stmt->bindValue(':country', $location->getCountry());
        $stmt->execute();
        return new location(
            $location->getName(),
            $location->getStreet(),
            $location->getCity(),
            $location->getZipCode(),
            $location->getCountry(),
            $id ?? $conn->lastInsertId()
        );
    }

    public function delete($id) {
        $query = 'DELETE FROM location WHERE ID_LOCATION = :id';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}