<?php
session_start();    
include '../connect.php'; // Kết nối với cơ sở dữ liệu

// Truy vấn danh sách người dùng
$sql = "SELECT user_id, username, email, is_approved, role, created_at FROM users";
$stmt = $conn->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!--           
    <tr>
        <td width="10"><input type="checkbox" name="check1" value="1"></td>
        <td>#CD12837</td>
        <td>Hồ Thị Thanh Ngân</td>
        <td>httngan@gmail.com </td>
        <td>12/02/1999</td>
        <td>Tác giả</td>
        <td><span class="badge bg-warning">Chờ phê duyệt</span></td>
        <td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"
            onclick="myFunction(this)"><i class="fas fa-trash-alt"></i>
        </button>
        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"
            data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-primary btn-sm edit" type="button" title="Phê duyệt" id="show-emp"
        data-toggle="modal" data-target="#ModalUP"><i class="fas fa-thumbs-up"></i>
        </button>
        </td>
    </tr>
 -->


<?php 
foreach ($users as $user): 
    echo "<tr>\n";
    echo    '<td width="10"><input type="checkbox" name="check1" value="1"></td>'."\n";
    echo    '<td>'.htmlspecialchars($user['user_id'])."</td>\n";
    echo    '<td>'.htmlspecialchars($user['username'])."</td>\n";
    echo    '<td>'.htmlspecialchars($user['email'])."</td>\n";
    echo    '<td>'.htmlspecialchars($user['created_at'])."</td>\n";
    echo    "<td>".htmlspecialchars($user['role'])."</td>\n";
    echo    '<td><span class="badge bg-warning">'.($user['is_approved'] ? 'Đã phê duyệt' : 'Chưa phê duyệt')."</span></td>\n";
    echo    '<td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button" title="Xóa" onclick="deleteItem('.$user['user_id'].')"><i class="fas fa-trash-alt"></i>';
    echo    "</button>\n";
    echo    '<button class="btn btn-primary btn-sm edit" type="button" title="Sửa" onclick="editItem('.$user['user_id'].')"><i class="fas fa-edit"></i>';
    echo    "</button>\n";
    echo    '<button class="btn btn-primary btn-sm edit" type="button" title="Phê duyệt" onclick="approveItem('.$user['user_id'].')"><i class="fas fa-thumbs-up"></i>';
    echo    "</button>\n";
    echo    "</td>\n";
    echo "</tr>\n";
endforeach;
    echo '<input type="hidden" name="csrf_token" id="csrf_token" value="'.($_SESSION['csrf_token'] ?? '').'">';
?>



