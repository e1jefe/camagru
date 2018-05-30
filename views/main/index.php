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
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                    Upload photo: <input name="userfile" type="file">
                    <input type="submit" value="Send File">
                </form>
<!--                <a>-->
<!--                    <label for="file-input">-->
<!--                        <img src="/public/images/catalog.png"/>-->
<!--                    </label>-->
<!--                    <form action="uploadphoto" enctype="multipart/form-data" method="post">-->
<!--                    <input name="image" id="file-input" style="display:none;" type="file"/>-->
<!--                        <input type="submit" value="Upload" />-->
<!--                    </form>-->
<!--                </a>-->

<!--                <form action="uploadphoto" enctype="multipart/form-data" method="post">-->
<!--                    <img src="/public/images/catalog.png"/> <input type="file" name="photo"/><BR/>-->
<!--                    <input type="submit" value="Upload" />-->
<!--                </form>-->
            </div>
            <?php endif; ?>
        </div>
        <div class="middle">
            <div class="hovergallery">
                <?php foreach ($vars as $item): ?>
                <img src=" <?php echo $item; ?> " alt="">
                <?php endforeach; ?>
            </div>
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
                            video.src = window.webkitURL.createObjectURL(stream);
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
        }
    </script>
    <?php endif; ?>
