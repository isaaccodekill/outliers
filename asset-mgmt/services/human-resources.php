<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/outliers/asset-mgmt/conn.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/outliers/asset-mgmt/services/common.php");

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

    private static function getUsersCountByStatus($status) {
        $result = self::$conn->query("SELECT COUNT(*) FROM users WHERE `status` = '$status';");
        $row = $result->fetch_row();
        return $row[0];
    }

    public static function getRequestsByStatus($status) {
        $query = "SELECT requests.id AS 'request.id', requests.title, requests.justification, requests.status, requests.createdAt, users.firstname, users.lastname FROM requests JOIN users ON requests.requesterId = users.id WHERE requests.`status` = '$status'";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // provides breakdown of requests by status
    public static function getDashboardStatistics() {
        $dataPoints["openRequests"] = self::getRequestsCountByStatus("open");
        $dataPoints["acceptedRequests"] = self::getRequestsCountByStatus("accepted");
        $dataPoints["redirectedRequests"] = self::getRequestsCountByStatus("redirected");
        $dataPoints["rejectedRequests"] = self::getRequestsCountByStatus("rejected");
        $dataPoints["activeUsers"] = self::getUsersCountByStatus("active");
        $dataPoints["inactiveUsers"] = self::getUsersCountByStatus("on-leave");
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
        $query = "INSERT INTO users (firstname, lastname, `status`, email, `password`, `role`) VALUES (?, ?, ?, ?, SHA(?), ?);";
        $stmt = self::$conn->prepare($query);
        $status = "active";
        $stmt->bind_param("ssssss", $firstName, $lastName, $status, $email, $password, $role);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    // returns an assoc list of all users
    public static function getAllEmployees() {
        $query = "SELECT * FROM users ORDER BY `status`, CASE WHEN `status` = 'active' THEN 1 WHEN `status` = 'on-leave' THEN 2 ELSE 3 END";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //returns all requests
    public static function getAllRequests() {
        $query = "SELECT requests.id AS 'request.id', requests.title, requests.justification, requests.status, requests.createdAt, users.firstname, users.lastname FROM requests JOIN users ON requests.requesterId = users.id ORDER BY requests.createdAt DESC";
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
        $query = "UPDATE users SET `status` = 'departed' WHERE id =?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("i", $employeeId);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    // true if success else false
    public static function editEmployee($employeeId, $firstName, $lastName, $role, $status, $email, $password) {
        $query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, `password` = ?, `status` = ?, `role` = ? WHERE id = ?;";
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("ssssssi", $firstName, $lastName, $role, $status, $email, $password, $employeeId);
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
        $query = "UPDATE requests SET `status` = 'redirected' WHERE id = ?;";
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