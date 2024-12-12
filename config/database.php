<?php

class Database {
    private static $host = 'localhost';
    private static $dbname = 'librairie';
    private static $user = 'root';
    private static $password = '';
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$user,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
