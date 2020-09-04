<?php
require_once 'util.php';

$add_comm = $pdo->prepare('SELECT * FROM Comment JOIN Users ON Comment.user_id = Users.user_id WHERE img_id = :iid ORDER BY comment_id');
$add_comm->execute(array(':iid' => $_GET['img']));
$comments = $add_comm->rowCount();
if ($comments > 0) {
    for ($i = 1; $i <= $comments; $i++) {
        $comment = $add_comm->fetch(PDO::FETCH_ASSOC);
        if ($comment !== false) {
            echo '<article>';
            echo '<div class="photo-user__block">';
            echo '<a href="me.php?user=' . htmlentities($comment['name']) . '&page=1&posts">';
            echo '<img class="photo-user__block-img" src="' . htmlentities($comment['avatar']) . '">';
            echo '</a></div>';
            echo '<div class="page_info_user"><span>' . htmlentities($comment['name']) . '</span> '; /* проверить */
            echo '<time>' . date("d M Y G:i", strtotime($comment['created_at_comment'])) . '</time>';
            if ($_SESSION['user_id'] == $row['user_id'] || $_SESSION['user_id'] == $comment['user_id']) {
                echo '<a href="#openModal' . $i . '">';
                echo '<img class="page-img_delete" src="img/icon/cancel.svg">';
                echo '</a>';
                echo '<div id="openModal' . $i . '" class="modal">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<p class="modal-title">Delete comment?</p>';
                echo '<p>This can’t be undone and it will be removed from your profile.</p>';
                echo '<form method="post" action="photo.php?img=' . $_GET['img'] . '">';
                echo '<input type="hidden" name="comment_id" value="' . htmlentities($comment['comment_id']) . '">';
                echo '<input type="submit" name="delete" class="btn-blue" value="Delete">';
                echo '<input type="submit" name="close" class="btn-gray" value="Close">';
                echo '</form></div></div></div>';
            }
            echo '<p>' . $comment['comment'] . '</p>';
            echo '</div></article>';
        }
    }
} else
    echo '<p class="count-message">There is no comment yet</p>';
