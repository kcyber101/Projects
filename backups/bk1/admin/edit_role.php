<?php
include '../connect.php';

if (isset($_POST['user_id']) && isset($_POST['role'])) {
    $userId = $_POST['user_id'];
    $role = $_POST['role'];
    $query = "UPDATE users SET role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $role, $userId);

    if ($stmt->execute()) {
        echo 'Role updated successfully.';
    } else {
        echo 'Error updating role.';
    }

    $stmt->close();
}

$conn->close();
?>
