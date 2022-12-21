<?php
require_once("../conn.php");

class EmployeeService {
    private static $conn = DB::getConnection();

    // returns true if insertion successful, else false
    public static function createRequest($title, $justification, $requesterId, $conn) {
        $query = "INSERT INTO requests (title, justification, requesterId) VALUES (?, ?, ?);";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("ssi", $title, $justification, $requesterId);
        return $stmt->execute();
    }

    // gets all requests made by employee
    public static function getEmployeeRequests($employeeId) {
        $query = "SELECT * FROM requests WHERE requesterId = ?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("i", $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQL_ASSOC);
    }
}

?>