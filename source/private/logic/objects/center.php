<?php

require_once('private/logic/db.php');
require_once('private/logic/objects/location.php');

class center implements JsonSerializable {
    private $id;
    private $name;
    private $location;

    public function __construct($name, $location, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => $this->location
        ];
    }
}

class CENTER_DB {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM center WHERE ID_CENTER = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $location_db = new LOCATION_DB();
        $location = $location_db->get($row['ID_LOCATION']);

        return new center($row['NAME'], $location, $row['ID_CENTER']);
    }

    public function search($name) {
        $query = 'SELECT * FROM center WHERE NAME LIKE :name';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindValue(':name', '%' . $name . '%');
        $stmt->execute();
        $centers = [];
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $location_db = new LOCATION_DB();
        foreach ($result as $row) {
            $location = $location_db->get($row['ID_LOCATION']);
            $centers[] = new center($row['NAME'], $location, $row['ID_CENTER']);
        }
        return $centers;
    }

    public function save(center $center){
        $location_db = new LOCATION_DB();
        $location = $location_db->save($center->getLocation());

        $conn = $this->db->getConnection();
        if ($center->getId()) {
            $id = $center->getId();
            $stmt = $conn->prepare('UPDATE center SET NAME = :name, ID_LOCATION = :location WHERE ID_CENTER = :id;');
            $stmt->bindValue(':id', $center->getId());
        } else {
            $stmt = $conn->prepare('INSERT INTO center (NAME, ID_LOCATION) VALUES (:name, :location);');
        }

        $stmt->bindValue(':name', $center->getName());
        $stmt->bindValue(':location', $location->getId());

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new center(
            $center->getName(),
            $location,
            $id ?? $conn->lastInsertId()
        );
    }

    public function delete($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('DELETE FROM center WHERE ID_CENTER = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}