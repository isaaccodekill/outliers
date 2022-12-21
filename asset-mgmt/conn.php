<?php

function initConn() {
    $conn = new mysqli("database", "root", "password", "assetmgmt");

    if ($conn->connect_error) {
        printf("connection failed: %s\n", mysqli_connect_error());
        exit();
    }
    return $conn;
}

// Singleton class providing DB Connection Object
class DB {
    private static $conn = null;

    public static function getConnection() {
        if (is_null(self::$conn)) {
            self::$conn = initConn();
        }
        return self::$conn;
    }
}

?>