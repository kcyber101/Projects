<?php
session_start();
include '../connect.php';

if (isset($_POST['article_id']) && isset($_POST['approve_request']) && $_POST['csrf_token'] && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor')) {
    $articleId = intval($_POST['article_id']);
    $csrf_token = $_POST['csrf_token'];
    $approve_request = str_replace(['<br>', '<br/>', '<br />'], '',$_POST['approve_request']);
    echo $approve_request;
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        die('Invalid CSRF token');
    }

    // check approve request
    if ( $approve_request === 'author_deleted' || $approve_request === 'author_edited' || $approve_request === 'post_created') {
        $check = "SELECT author_deleted, author_edited, post_created FROM articles WHERE article_id = ?";
        $stmt = $conn->prepare($check);
        $stmt->execute([$articleId]);
        $result = $stmt->fetch();

        // Double check if the article is already approved
        if ($result['post_created'] == 1 || $result['author_edited'] == 1) {
            $sql = "UPDATE articles SET is_approved = TRUE, post_created = FALSE, author_edited = FALSE  WHERE article_id = ?  ";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$articleId])) {
                echo 'true';
            } else {
                echo 'false';
                die('Error updating article status');
            }
        }elseif ($result['author_deleted'] == 1) {
            //delete the article from database with article_id = $articleId
            $sql = "DELETE FROM articles WHERE article_id = ? ";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$articleId])) {
                echo 'true';
            } else {
                echo 'false';
                die('Error updating article status');
            }
        }else {
            die('Error updating article status');
        }
    }



    //UPDATE articles SET is_approved = TRUE, post_created = FALSE  WHERE article_id = 12 AND post_created = TRUE
    
    // Cập nhật tình trạng phê duyệt

}
?>

