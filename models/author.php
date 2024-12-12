<?php

require_once '../config/Database.php';

class Author {
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM authors");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getIdByName($name) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT id FROM authors WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;  // Retourne l'ID si trouvé, sinon null
    }

    public static function create($name) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO authors (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);
        return $db->lastInsertId();  // Retourne l'ID du nouvel auteur
    }
}
