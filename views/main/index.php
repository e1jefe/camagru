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
                    <button><img src=/public/images/like2.png></button>
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
