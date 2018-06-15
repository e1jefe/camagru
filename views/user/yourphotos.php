<div class="main">
    <div class="left">
        <?php if(isset($_SESSION['login'])): ?>
            <div class="btn-photo">
                <a class="btn-photo" onclick="" href="http://localhost:8082/photo">
                    <img src="/public/images/camera.png">
                </a>
            </div>

        <?php endif; ?>
    </div>
    <div class="middle">
        <div class="picture-post">
            <?php foreach ($vars['posts'] as $post): ?>
               <?php die("<pre>" . print_r($vars, true) . "</pre>"); ?>
            <p> <b> <?= $post['user_login'] ?></b></p>
            <div class="hovergallery">
                <?php
                if(($post['user_id']) == ($_SESSION['user_id'])): ?>
                {
                <img src=" <?php echo $post['source']; ?> " alt="">
                }
                <?php endif; ?>
            </div>
            <?php if(isset($_SESSION['login'])): ?>
                <form action="likecounter" method="post" name="like">
                    <div class="like-holder">
                        <a class="likes" id="<?=$post['id_pic'] ?>">
                            <input type="hidden" name="id_pic" value="<?$post['id_pic'] ?>">
                            <img src="/public/images/<?= in_array($post['id_pic'], $vars['liked_photos']) ? 'like1.png' : 'like2.png' ?>">
                        </a>

                        <p><?= $post['likes'] ?></p>
                    </div>
                </form>

                <div data-post-id="<?=$post['id_pic'] ?>" class="comments">
                    <p> <textarea readonly cols="40" rows="3" style="resize: none; background-color: #F0FFFF; border: none"> <?php $vars['comment'][0]['comment']?> </textarea></p>
                    <a href="#" title="Add comment" class="add-comment">
                        <img src="/public/images/comm.png">
                    </a>
                    <div style="display: none;">
                        <textarea  maxlength="140" placeholder=" enter comment..." name="text" cols="30" rows="2"  style="resize: none"></textarea>
                        <input type="submit" name="send" value="Ok" pic-id="<?=$post['id_pic']?>">
                    </div>
                </div>
                <?php if(($_SESSION['user_id']) == $post['user_id']): ?>
                    <div id="" class="deletephoto">
                        <a href="deletephoto?id_pic=<?=$post['id_pic'] ?>" title="Add comment" class="del-photo">
                            <img src="/public/images/delete.png">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
<?php endforeach; ?>
        </div>
        <pre>

            </pre>
    </div>
    <div class="right"></div>
</div>

<?php if(isset($_SESSION['login'])): ?>
    <script>
        const btn = document.getElementsByClassName('likes');
        for (i=0;i<btn.length;i++)
        {
            btn[i].addEventListener('click', like, false);
        };
        function like() {
            var item = this.getAttribute('id');
            var body = "key=" + item;
            var request = new XMLHttpRequest();
            request.open("POST", "http://localhost:8082/likecounter", true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.addEventListener("load", function(event) {
                console.log(event.target.responseText);
                var tmp = document.getElementById(item);
                var likeAmount = event.target.responseText;
                var oldLike = parseInt(tmp.nextElementSibling.innerHTML);
                if (likeAmount - oldLike == 1)
                    tmp.getElementsByTagName('img')[0].setAttribute('src', '/public/images/like1.png')
                else
                    tmp.getElementsByTagName('img')[0].setAttribute('src', '/public/images/like2.png')
                tmp.nextElementSibling.innerHTML = likeAmount;
            });
            request.send(body);
        };
    </script>
<?php endif; ?>

<?php if(isset($_SESSION['login'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let addcommentButtons = document.getElementsByName('send');
            for (let i = 0; i < addcommentButtons.length; i++) {
                addcommentButtons[i].addEventListener('click', function (e) {
                    e.preventDefault();
                    var picId = e.target.getAttribute('pic-id');
                    var msg = e.target.parentElement.firstChild.nextElementSibling.value;
                    if (msg.length > 0) {
                        const request = new XMLHttpRequest();
                        var body = 'commentTxt=' + msg + '&picId=' + picId;
                        console.log(body);
                        request.open("POST", "http://localhost:8082/comments", true);
                        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        request.addEventListener("load", function (event) {
                            console.log(event.target.responseText);
                            e.target.parentElement.firstChild.nextElementSibling.value = "";
                        });
                        request.send(body);
                    }
                    else return false;
                })
            }
        });
    </script>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let commentButtons = document.getElementsByClassName('add-comment');
        for (let i = 0; i < commentButtons.length; i++) {
            commentButtons[i].addEventListener('click', function (e) {
                e.preventDefault();
                if (e.target.parentElement.nextElementSibling.style.display == 'none') {
                    e.target.parentElement.nextElementSibling.style.display = 'block';
                }
                else
                    e.target.parentElement.nextElementSibling.style.display = 'none';
            })
        }
    });
</script>
