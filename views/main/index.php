<div class="main">
        <div class="left">
            <?php if(isset($_SESSION['login'])): ?>
            <div class="btn-photo">
                <a class="btn-photo" onclick="">
                    <img src="/public/images/camera.png">
                </a>
            </div>
            <div class="btn-folder">

                <form enctype="multipart/form-data" action="uploadphoto" method="post">
                    <input type="hidden" name="MAX_FILE_SIZE" value="64000">
                    Send photo: <input name="userfile" type="file">
                    <input type="submit" value="Send File">
                </form>
            </div>
            <?php endif; ?>
        </div>
        <div class="middle">
            <?php foreach ($vars as $item): ?>
            <div class="hovergallery">
                <img src=" <?php echo $item; ?> " alt="">
                </div>
                <div class="likes">
                    <a class="likes" onclick="">
                       <img src=/public/images/like2.png>
                    </a>
                </div>
                        <?php endforeach; ?>
        </div>

        <div class="right"></div>
    </div>
    <?php if(isset($_SESSION['login'])): ?>
    <video autoplay muted></video>
    <script>
        var photo = document.getElementsByClassName('btn-photo');
        photo[0].addEventListener('click', function () {
            {
                if (navigator.webkitGetUserMedia != null) {
                    var options = {
                        video: true,
                        audio: true
                    };
// запрашиваем доступ к веб-камере
                    navigator.webkitGetUserMedia(options,
                        function (stream) {
// получаем тег video
                            var video = document.querySelector('video');
// включаем поток в магический URL
                            video.srcObject = stream;
                        },
                        function () {
                            console.log("error happened");
                        }
                    );
                }
            }
        })
    </script>
    <form ><input type='button' id='snapshot' value="snapshot"></form>
    <canvas id='canvas' width='640' height='480' ></canvas>
    <script>
        document.getElementById('snapshot').onclick = function() {
            var video = document.querySelector('video');
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            ctx.drawImage(video,0,0,640,480);
            var img = canvas.toDataURL();
            var request = new XMLHttpRequest();
            request.open("POST", "http://localhost:8082/uploadphoto", true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var body = 'image=' + img;
            request.addEventListener("load", function(event) {
                console.log(event.target.responseText);
            });
            request.send(body);
        };
    </script>
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