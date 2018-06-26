<div class="btn-photo">
    <a class="btn-photo" onclick="">
        <img src="/public/images/camera.png">
    </a>
</div>
<div class="btn-folder">

    <form enctype="multipart/form-data" action="uploadphoto" method="post">
        <input  type="hidden" name="MAX_FILE_SIZE" value="64000">
        <input  name="userfile" type="file" >
<!--        <img src="/public/images/catalog.png">-->
        <input type="submit" value="Send File">
    </form>
</div>
<div id="camera" style="display: flex; width: 100%; margin-top: 100px; margin-left: 100px; position: relative;" >
    <?php if (isset($_SESSION['login'])): ?>
    <video autoplay muted "></video>
    <div id="place" style="position: absolute; top: 20px; width: 640px; height: 480px;">

    </div>
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
                document.getElementById('stick').style.display = "flex";
                document.getElementById('stick').style.flexDirection = "column";
            }
        })
    </script>
    <div id="stick" style="display: none; " >
        <img width="40px" height="60px" src="/public/images/1.png" >
        <img width="40px" height=60 src="/public/images/3.png" >
        <img width="40px" height=140 src="/public/images/4.png" >
        <img width="40px" height=140 src="/public/images/5.png" >
        <img width="40px" height=60 src="/public/images/6.png" >
        <img width="40px" height=60 src="/public/images/7.png" >

        <script>
                var pattern = document.querySelector('#stick').children;
                for (var i = 0, child; child = pattern[i]; i++) {
                    child.onclick = function () {
                        var parElem = document.getElementById('place');
                        var elem = document.getElementById('new_stick');
                        if (elem) {
                            elem.remove();
                        }
                        var newElem = document.createElement('img');
                        newElem.id = 'new_stick';
//                        newElem.style.position = 'absolute';
                        newElem.height = 300;
                        newElem.width = 300;
                        newElem.src = this.src;
                        window.localStorage.globalVar = newElem.src;
                        parElem.appendChild(newElem);
                    };
                    child.ondblclick = function () {
                        var elem = document.getElementById('new_stick');
                        if (elem) {
                            if (elem.src = this.src) {
                                elem.remove();
                            }
                        }
                    };
            }
        </script>
    </div>
</div>
<form><input type='button' id='snapshot' value="Save photo" onclick="snap()"></form>
<canvas id='canvas' width='640' height='480'></canvas>

    <script>
            document.getElementById('snapshot').onclick = function () {
                var video = document.querySelector('video');
                var canvas = document.getElementById('canvas');
                var stick = window.localStorage.globalVar;
                var img = new Image();
                img.src = stick;
                console.log(img);
                var ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, 640, 480);
                ctx.drawImage(img, 0, 0, 300, 300);

                var img = canvas.toDataURL('image/png');
                var request = new XMLHttpRequest();
                request.open("POST", "https://camagru.dsheptun.live/uploadphoto", true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                var body = 'image=' + img + '&stick=' + stick;
                request.send(body);
                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                    }
                }
            };

    </script>
<?php endif; ?>