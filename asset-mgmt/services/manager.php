<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/conn.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/services/common.php");

class ManagerService {
    private static $conn;

    static function init() {
        self::$conn = DB::getConnection();
    }


    // return assoc list of all incoming requests
    public static function getRedirectedRequests() {
        $query = "SELECT requests.id, requests.title, requests.justification, requests.status, requests.createdAt, users.firstname, users.lastname FROM requests JOIN users ON requests.requesterId = users.id WHERE `status` = 'redirected'";
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // true if success else false
    public static function acceptRequest($requestId) {
        $query = "UPDATE requests SET `state` = 'accepted', resolvedAt = NOW() WHERE id = ?;";
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
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

ManagerService::init();
?>