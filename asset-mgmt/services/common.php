<?php
    // true if success else false
    function rejectRequest($requestId, $conn) {
        $query = "UPDATE requests SET `state` = 'rejected', resolvedAt = NOW() WHERE id = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $requestId);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }
?>