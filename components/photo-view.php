<section class="page-img align_footer">
    <div class="container">
        <div class="page-img__photo">
            <div class="page-img__photo-block">
                <img src="<?= htmlentities($row['path']) ?>">
                <form class="page-img__photo-likes" method="post">
                    <button type="submit" name="likes">
                        <img class="photo-like" src="<?= $src ?>" alt="like">
                    </button>
                </form>
            </div>

            <div class="page-img__photo-info">
                <p><span><?= htmlentities(changeNumber($view['views'])) ?></span> Views</p>
                <p><span><?= htmlentities(changeNumber($row['likes'])) ?></span> Likes</p>

                <div>
                    <p>Share:</p>
                    <!-- esc_url( sprintf( 'http://www.twitter.com?status=%s', urlencode( $message ) ) ); -->
                    <a class="btn btn-default btn-lg" target="_blank" title="facebook" href="http://www.facebook.com/sharer.php?u=http://localhost:8080/photo.php?img=<?= $_GET['img'] ?>&text=True%20story">
                        <img src="../img/icon/facebook.svg" alt="fb">
                    </a>
                    <a class="btn btn-default btn-lg" target="_blank" title="twitter" href="http://twitter.com/share?url=http://localhost:8080/photo.php?img=<?= $_GET['img'] ?>&text=True%20story">
                        <img src="../img/icon/twitter.svg" alt="tw">
                    </a>
                    <a class="btn btn-default btn-lg" target="_blank" title="vk" href="http://vk.com/share.php?url=http://localhost:8080/photo.php?img=<?= $_GET['img'] ?>&text=True%20story">
                        <img src="../img/icon/vk.svg" alt="vk">
                    </a>
                </div>

            </div>

            <p class="page-img__photo-description"><?= htmlentities($row['description_photo']) ?></p>
            <time><?= date("d M Y G:i", strtotime($row['created_at_photo'])) ?></time>

            <a class="page-img__photo-user" href="me.php?user=<?= htmlentities($row['name']) ?>&page=1&posts">
                <div class="photo-user__block">
                    <img class="photo-user__block-img" src="<?= htmlentities($row['avatar']) ?>">
                </div>
                <p><?= htmlentities($row['name']) ?></p>
            </a>
        </div>

        <div class="page-img__comments">
            <div class="page-img__comments-set">
                <h2>Comments</h2>
                <form class="page-img__comments-set__form" method="post">
                    <span class="span_comment">No more than 80 characters</span>
                    <textarea id="text" name="text_comment" rows="1" placeholder="Leave a comment"></textarea>
                    <button id="save-btn" class="btn-blue" type="submit">Send</button>
                </form>
            </div>

            <div class="page-img__comments-list">

            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        document.getElementById("save-btn").addEventListener("click", function() {

            let xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector('.page-img__comments-list').innerHTML = this.responseText;
                }
            };
            
            xhttp.open("GET", "aj_add.php?img=6", true);
            xhttp.send();
        }, false);
    })();
</script>