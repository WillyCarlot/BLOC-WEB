<?php

require_once('private/logic/db.php');
require_once('private/logic/objects/center.php');

class promotion implements JsonSerializable {
    private $id;
    private $name;
    private $center;

    public function __construct($name, $center, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->center = $center;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCenter() {
        return $this->center;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCenter($center) {
        $this->center = $center;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'center' => $this->center
        ];
    }
}

class PROMOTION_DB{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM promotion WHERE ID_PROMOTION = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $center_db = new CENTER_DB();
        $center = $center_db->get($row['ID_CENTER']);

        return new promotion($row['NAME'], $center, $row['ID_PROMOTION']);
    }

    public function search($name) {
        $query = 'SELECT * FROM promotion WHERE NAME LIKE :name';
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindValue(':name', '%'.$name.'%');
        $stmt->execute();

        $promotions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $center_db = new CENTER_DB();
            $center = $center_db->get($row['ID_CENTER']);

            $promotion = new promotion($row['NAME'], $center, $row['ID_PROMOTION']);
            $promotions[] = $promotion;
        }

        return $promotions;
    }

    public function save(promotion $promotion) {
        $center_db = new CENTER_DB();
        $center = $center_db->save($promotion->getCenter());

        $conn = $this->db->getConnection();
        if ($promotion->getId()) {
            $id = $promotion->getId();
            $stmt = $conn->prepare('UPDATE promotion SET NAME = :name, ID_CENTER = :id_center WHERE ID_PROMOTION = :id;');
            $stmt->bindValue(':id', $promotion->getId());
        } else {
            $stmt = $conn->prepare('INSERT INTO promotion (NAME, ID_CENTER) VALUES (:name, :id_center);');
        }
        $stmt->bindValue(':name', $promotion->getName());
        $stmt->bindValue(':id_center', $center->getId());
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new promotion(
            $promotion->getName(),
            $center,
            $id ?? $conn->lastInsertId()
        );
    }

    public function delete($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('DELETE FROM promotion WHERE ID_PROMOTION = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
