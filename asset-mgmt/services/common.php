<?php
    // true if success else false
    function rejectRequest($requestId, $conn) {
        $query = "UPDATE request SET `state` = 'rejected' WHERE id = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $requestId);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }
?>