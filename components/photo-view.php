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
                <div class="page-img__comments-set__form">
                    <span class="span_comment">No more than 80 characters</span>
                    <textarea id="text" name="text_comment" rows="1" placeholder="Leave a comment"></textarea>
                    <button class="btn-blue btn-save" type="submit">Send</button>
                </div>
            </div>

            <div class="page-img__comments-list">

            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        function getComments() {
            let xhttp;
            let url = "aj_get.php?";

            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector('.page-img__comments-list').innerHTML = this.responseText;
                    document.querySelectorAll(".btn-confirm-del").forEach(item => item.addEventListener("click", function() {
                        let param = "commentID=" + this.id;
                        let xhttp;

                        xhttp = new XMLHttpRequest();
                        xhttp.open("POST", "aj_delete.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                console.log("ok");
                                getComments();
                            }
                        };

                        xhttp.send(param);
                    }, false));

                    document.querySelectorAll(".page-img_delete").forEach(item => item.addEventListener("click", function() {
                        document.querySelectorAll(".modal").forEach(item => item.style.display = "block");
                    }, false));
                    document.querySelectorAll(".btn-close").forEach(item => item.addEventListener("click", function() {
                        document.querySelectorAll(".modal").forEach(item => item.style.display = "none");
                    }, false));
                };
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        document.querySelector(".btn-save").addEventListener("click", function() {
            let text = document.getElementById('text').value;
            let param = "comment=" + text;
            let xhttp;

            xhttp = new XMLHttpRequest();
            xhttp.open("POST", "aj_new.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    getComments();
                    document.getElementById('text').value = '';
                }
            };

            xhttp.send(param);
        }, false);

        window.addEventListener("load", getComments, false);
    })();
</script>