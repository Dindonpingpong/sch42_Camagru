<?php
if (session_status() == PHP_SESSION_NONE)
session_start();
require_once "util.php";

if (isset($_POST['delete'])) {
    if (isset($_POST['comment_id']) && $_POST['comment_id'] && $_SESSION['user_id']) {
        $stmt = $pdo->prepare('DELETE FROM Comment WHERE comment_id = :cid');
        $stmt->execute(array(':cid' => $_POST['comment_id'])); /* проверить */
    }
}