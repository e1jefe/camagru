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
<div id="camera" style="display: flex; width: 100%; margin-top: 100px; margin-left: 100px">
    <?php if (isset($_SESSION['login'])): ?>
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
                        var parElem = document.getElementById('camera');
                        var elem = document.getElementById('new_stick');
                        if (elem) {
                            elem.remove();
                        }
                        var newElem = document.createElement('img');
                        newElem.id = 'new_stick';
                        newElem.style.position = 'absolute';
                        newElem.height = 300;
                        newElem.width = 100;
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
<form><input type='button' id='snapshot' value="snapshot" onclick="snap()"></form>
<canvas id='canvas' width='640' height='480'></canvas>

    <script>
            document.getElementById('snapshot').onclick = function () {
                var video = document.querySelector('video');
                var canvas = document.getElementById('canvas');
                var ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, 640, 480);
                var stick = window.localStorage.globalVar;
                var img = canvas.toDataURL('image/png');
                var request = new XMLHttpRequest();
                var response = request.responseText;
                request.open("POST", "http://localhost:8082/uploadphoto", true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                var body = 'image=' + img + '&stick=' + stick;
                request.send(body);
                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                        console.log(request.responseText);
                    }
                }
            };
//            var img = new Image();
//            img.addEventListener("load", function() {
//                canvas.getContext("2d").drawImage(img, 0, 0, 640, 480);
//
//            });
//            img.src = someLink;
    </script>
<?php endif; ?>