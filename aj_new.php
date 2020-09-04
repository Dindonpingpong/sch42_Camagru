<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
require_once 'util.php';

if (isset($_POST['comment'])) /* valid */ {
    $stmt = $pdo->prepare('INSERT INTO Comment (user_id, img_id, comment) VALUES (:uid, :iid, :cm)');
    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':iid' => $_SESSION['img'],
        ':cm' => nl2br(substr(htmlentities($_POST['comment']), 0, 80))
    ));
    /* mail  надо проверить*/
    if ($row['notification'] == 'yes') {
        $email = $row['email'];
        $subject = 'New comment';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: amilyukovadev@gmail.com\r\n";
        $message = '<p>You have new comment on <a href="http://localhost:8080/photo.php?img=' . $_GET['img'] . '">photo</a></p>
        <p>To unsubscribe from this thread, please <a href="">click here</a></p>';
        mail($email, $subject, $message, $headers);
    }
}
