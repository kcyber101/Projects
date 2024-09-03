<?php
include '../connect.php';

$query = "SELECT user_id, username, email, role, is_approved FROM users";
$result = $conn->query($query);

if ($result->rowCount() > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch()) {
        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
        echo '<td>' . ($row['is_approved'] ? 'Approved' : 'Pending') . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No users found.</p>';
}

?>
