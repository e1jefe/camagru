
<div class="main">
        <div class="left">
            <?php if(isset($_SESSION['login'])): ?>
            <div class="btn-photo">
                <a class="btn-photo" onclick="" href="http://localhost:8082/photo">
                    <img src="/public/images/camera.png">
                </a>
            </div>
<!--            <div class="btn-folder">-->
<!---->
<!--                <form enctype="multipart/form-data" action="uploadphoto" method="post">-->
<!--                    <input type="hidden" name="MAX_FILE_SIZE" value="64000">-->
<!--                    Send photo: <input name="userfile" type="file">-->
<!--                    <input type="submit" value="Send File">-->
<!--                </form>-->
<!--            </div>-->
            <?php endif; ?>
        </div>
        <div class="middle">
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
                <?php endif; ?>
                        <?php endforeach; ?>
        </div>
        <div class="right"></div>
    </div>

    <?php if(isset($_SESSION['login'])): ?>
<!--    <video autoplay muted></video>-->
<!--    <script>-->
<!--        var photo = document.getElementsByClassName('btn-photo');-->
<!--        photo[0].addEventListener('click', function () {-->
<!--            {-->
<!--                if (navigator.webkitGetUserMedia != null) {-->
<!--                    var options = {-->
<!--                        video: true,-->
<!--                        audio: true-->
<!--                    };-->
<!--// запрашиваем доступ к веб-камере-->
<!--                    navigator.webkitGetUserMedia(options,-->
<!--                        function (stream) {-->
<!--// получаем тег video-->
<!--                            var video = document.querySelector('video');-->
<!--// включаем поток в магический URL-->
<!--                            video.srcObject = stream;-->
<!--                        },-->
<!--                        function () {-->
<!--                            console.log("error happened");-->
<!--                        }-->
<!--                    );-->
<!--                }-->
<!--                document.getElementById('stick').style.display= "flex";-->
<!--            }-->
<!--        })-->
<!--    </script>-->
<!--    <form ><input type='button' id='snapshot' value="snapshot"></form>-->
<!--    <canvas id='canvas' width='640' height='640' ></canvas>-->
<!--    <script>-->
<!--        document.getElementById('snapshot').onclick = function() {-->
<!--            var video = document.querySelector('video');-->
<!--            var canvas = document.getElementById('canvas');-->
<!--            var ctx = canvas.getContext('2d');-->
<!--            ctx.drawImage(video,0,0,640,640);-->
<!--            var img = canvas.toDataURL();-->
<!--            var request = new XMLHttpRequest();-->
<!--            request.open("POST", "http://localhost:8082/uploadphoto", true);-->
<!--            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');-->
<!--            var body = 'image=' + img;-->
<!--            request.addEventListener("load", function(event) {-->
<!--                console.log(event.target.responseText);-->
<!--            });-->
<!--            request.send(body);-->
<!--        };-->
<!--    </script>-->

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
        <div id="stick" style="display: none">
            <img width=40 height=60 src="/public/images/1.png">
            <img width=40 height=60 src="/public/images/2.png">
            <img width=40 height=60 src="/public/images/3.png">
            <img width=60 height=140 src="/public/images/4.png">
            <img width=60 height=140 src="/public/images/5.jpg">
        </div>
    <?php endif; ?>


<!--window.addEventListener("DOMContentLoaded", function() {-->
<!--// recuperation des canvas.-->
<!--var canvas = document.getElementById('canvas');-->
<!--var canvas_upload = document.getElementById('canvas_upload');-->
<!--var canvas_backup = document.getElementById('canvas_backup');-->
<!---->
<!--if (canvas)-->
<!--{-->
<!--var context = canvas.getContext('2d');-->
<!--}-->
<!---->
<!--else if (canvas_upload) {-->
<!--var context_canvas_upload = canvas_upload.getContext('2d');-->
<!--}-->
<!---->
<!---->
<!--function change_filtre(filtre) {-->
<!--if (canvas) {-->
<!--context.drawImage(canvas_backup, 0, 0, 600, 450);-->
<!--context.drawImage(filtre, 250, 0, 120, 120);-->
<!--}-->
<!--else {-->
<!--context_canvas_upload.drawImage(canvas_backup, 0, 0, 600, 450);-->
<!--context_canvas_upload.drawImage(filtre, 250, 0, 120, 120);-->
<!--}-->
<!--}-->
<!---->
<!---->
<!--var radios = document.getElementsByName('filtre');-->
<!--var image = document.getElementsByName('image_filtre');-->
<!---->
<!--for (var i = 0; i < radios.length; i++) {-->
<!--radios[i].addEventListener('click', (function(i) {-->
<!--return function () {-->
<!--var filtre = new Image();-->
<!--filtre.src = image[i].src;-->
<!--filtre.onload = change_filtre(filtre);-->
<!--};-->
<!--})(i));-->
<!--}-->
<!---->
<!--}, false);-->