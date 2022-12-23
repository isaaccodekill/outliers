<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/outliers/asset-mgmt/conn.php");

class AuthService {
    private static $conn;

    static function init() {
        self::$conn = DB::getConnection();
    }

    // returns user data in association table if credentials are correct, else returns null, returns null if user departed
    public static function authenticate($email, $password) {
        $query = "SELECT * FROM users WHERE email = ? AND `password` = SHA(?);";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        $stmt->close();
        $data = $result->fetch_assoc();
        if ($data["status"] === "departed") {
            return null;
        }
        return $data;
    }
}

AuthService::init();

?>