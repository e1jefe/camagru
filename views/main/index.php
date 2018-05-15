    <div class="main">
        <div class="left">
            <div class="btn-photo">
                <a class="btn-photo" onclick="">
                    <img src="/public/images/camera.png">
                </a>
            </div>
            <div class="btn-folder">
                <a>
                    <label for="file-input">
                        <img src="/public/images/catalog.png"/>
                    </label>

                    <input id="file-input" style="display:none;" type="file"/>
                </a>
            </div>
        </div>
        <div class="middle">
            <div class="hovergallery">
                <?php foreach ($vars as $item): ?>
                <img src="
<?php
                echo $item;
                ?>
" alt="">
                <?php endforeach; ?>
            </div>

        </div>

        <div class="right"></div>
    </div>
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

