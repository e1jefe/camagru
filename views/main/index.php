
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
            <?php foreach ($vars['posts'] as $item => $value): ?>
            <div class="hovergallery">
                <img src=" <?php echo $item; ?> " alt="">
                </div>
                <?php if(isset($_SESSION['login'])): ?>
                <form action="likecounter" method="post" name="like">
                <div class="like-holder">
                    <a class="likes" id="<?= $item?>">
                        <input type="hidden" name="source">
                        <img src="/public/images/<?= in_array($item, $vars['liked_photos']) ? 'like1.png' : 'like2.png' ?>">
                    </a>
                    <p><?= $value ?></p>
                    <br>
                </div>

                </form>
                    <div class="comments">
                        <p><Br>
                            <textarea name="comment" cols="30" rows="2"></textarea></p>
                        <p><input type="submit" value="Send">
                        </p>
                    </div>
                <?php endif; ?>
                        <?php endforeach; ?>
            </div>
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
            function like(e) {
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
<!--        <div id="stick" style="display: none">-->
<!--            <img width=40 height=60 src="/public/images/1.png">-->
<!--            <img width=40 height=60 src="/public/images/3.png">-->
<!--            <img width=60 height=140 src="/public/images/4.png">-->
<!--            <img width=60 height=140 src="/public/images/5.png">-->
<!--        </div>-->
    <?php endif; ?>
