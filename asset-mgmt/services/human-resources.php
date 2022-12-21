<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/conn.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/services/common.php");

class HRService {
    private static $conn;

    static function init() {
        self::$conn = DB::getConnection();
    }

    public static function checkEmailInUse($email) {
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }

    // returns true if insertion successful, else false
    public static function createEmployee($firstName, $lastName, $role, $email, $password) {
        $query = "INSERT INTO users (firstname, lastname, email, `password`, `role`) VALUES (?, ?, ?, SHA(?), ?);";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $password, $role);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    // returns an assoc list of all users
    public static function getAllEmployees() {
        $query = "SELECT * FROM users";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // returns null if user does not exist, else assoc list
    public static function getEmployee($employeeId) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("i", $employeeId);
        if (!$stmt->execute()) {
            return null;
        }
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // true if success else false
    public static function deleteEmployee($employeeId) {
        $query = "DELETE FROM users WHERE id =?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("i", $employeeId);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    // true if success else false
    public static function editEmployee($employeeId, $firstName, $lastName, $role, $email, $password) {
        $query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, `password` = ?, `role` = ? WHERE id = ?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("sssssi", $firstName, $lastName, $role, $email, $password, $employeeId);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    // return assoc list of all incoming requests
    public static function getIncomingRequests() {
        $query = "SELECT * FROM requests WHERE `status` = 'open'";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // true if success else false
    public static function redirectRequest($requestId) {
        $query = "UPDATE request SET `state` = 'redirected' WHERE id = ?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("i", $requestId);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    // true if success else false
    public static function rejectRequest($requestId) {
        return rejectRequest($requestId, self::$conn);
    }

    // return assoc list of all resolved requests
    public static function getResolvedRequests() {
        $query = "SELECT * FROM requests WHERE `status` in ('accepted', 'rejected')";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // return assoc list of all approved requests and users that made them
    public static function getApprovedRequests() {
        $query = "SELECT * FROM requests JOIN users on users.id = requests.requesterId WHERE `status` = 'accepted'";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

HRService::init();
?>