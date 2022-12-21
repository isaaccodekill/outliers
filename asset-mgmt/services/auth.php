<?php
require_once("../conn.php");

class AuthService {
    private static $conn = DB::getConnection();

    // returns user data in association table if credentials are correct, else returns null
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
        return $result->fetch_assoc();
    }
}

?>