<?php
require_once('private/logic/db.php');

class skill implements JsonSerializable {
    private $id;
    private $name;


    public function __construct($name, $id = null) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}

class SKILL_DB {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($id) {
        $query = 'SELECT * FROM skill WHERE ID_SKILL = :id';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new skill($row['NAME'], $row['ID_SKILL']);
    }

    public function search($name) {
        $query = 'SELECT * FROM skill WHERE NAME LIKE :name';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindValue(':name', '%' . $name . '%');
        $stmt->execute();
        $locations = [];
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $locations[] = new skill($row['NAME'], $row['ID_SKILL']);
        }
        return $locations;
    }

    public function save(skill $location) {
        $conn = $this->db->getConnection();
        if ($location->getId()){
            $id = $location->getId();
            $stmt = $conn->prepare('UPDATE skill SET NAME = :name WHERE ID_SKILL = :id;');
            $stmt->bindValue(':id', $location->getId());
        } else {
            $stmt = $conn->prepare('INSERT INTO skill (NAME) VALUES (:name);');
        }
        $stmt->bindValue(':name', $location->getName());
        $stmt->execute();
        return new skill(
            $location->getName(),
            $id ?? $conn->lastInsertId()
        );
    }

    public function delete($id) {
        $query = 'DELETE FROM skill WHERE ID_SKILL = :id';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}