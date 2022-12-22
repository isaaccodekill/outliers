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

    private static function getRequestsCountByStatus($status) {
        $result = self::$conn->query("SELECT COUNT(*) FROM requests WHERE `status` = '$status';");
        $row = $result->fetch_row();
        return $row[0];
    }

    private static function getRequestsByStatus($status) {
        $query = "SELECT * FROM requests JOIN users ON users.id = requests.requesterId WHERE `status` = '$status' ORDER BY requests.createdAt DESC";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // provides breakdown of requests by status
    public static function getDashboardStatistics() {
        $dataPoints["open"] = self::getRequestsCountByStatus("open");
        $dataPoints["accepted"] = self::getRequestsCountByStatus("accepted");
        $dataPoints["redirected"] = self::getRequestsCountByStatus("redirected");
        $dataPoints["rejected"] = self::getRequestsCountByStatus("rejected");
        return $dataPoints;
    }

    // returns top 5 latest requests
    public static function getLatestRequests() {
        $query = "SELECT * FROM requests JOIN users ON users.id = requests.requesterId ORDER BY requests.createdAt DESC LIMIT 5;";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
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
        return self::getRequestsByStatus("open");
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

    public static function getRedirectedRequests() {
        return self::getRequestsByStatus("redirected");
    }

    public static function getRejectedRequests() {
        return self::getRequestsByStatus("rejected");
    }

    // return assoc list of all approved requests and users that made them
    public static function getApprovedRequests() {
        return self::getRequestsByStatus("accepted");
    }
}

HRService::init();
?>