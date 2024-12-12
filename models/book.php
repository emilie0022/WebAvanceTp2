<?php

require_once '../config/Database.php';

class Book {
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($title, $author_id, $category_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO books (title, author_id, category_id) VALUES (:title, :author_id, :category_id)");
        $stmt->execute(['title' => $title, 'author_id' => $author_id, 'category_id' => $category_id]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }


    public static function getById($id) {
    $db = Database::connect();
    $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);  
}

}
