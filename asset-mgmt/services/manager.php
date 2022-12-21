<?php
require_once("../conn.php");
require_once("./common.php");

class ManagerService {
    private static $conn = DB::getConnection();

    // return assoc list of all incoming requests
    public static function getRedirectedRequests() {
        $query = "SELECT * FROM requests JOIN users ON requests.requesterId = users.id WHERE `status` = 'redirected'";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQL_ASSOC);
    }

    // true if success else false
    public static function acceptRequest($requestId) {
        $query = "UPDATE request SET `state` = 'accepted' WHERE id = ?;";
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

    // return assoc list accepted + rejected + redirected
    public static function getAllConcernedRequests() {
        $query = "SELECT * FROM requests WHERE `status` in ('accepted', 'rejected', 'redirected')";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQL_ASSOC);
    }
}
?>