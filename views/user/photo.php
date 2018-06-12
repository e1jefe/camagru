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
//                document.getElementById('camera').style.flexDirection= "row";
                document.getElementById('stick').style.flexDirection = "column";
            }
        })
    </script>
    <div id="stick" style="display: none; " >
        <img id="1" width="40px" height="60px" src="/public/images/1.png" >
        <img width="40px" height=60 src="/public/images/2.png" >
        <img width="40px" height=60 src="/public/images/3.png" >
        <img width=60 height=140 src="/public/images/4.png" >
        <img width=60 height=140 src="/public/images/5.jpg" >

        <script>
//            function take_stick() {

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


//                }
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
             //   console.log(window.localStorage.globalVar);
                console.log(stick);
                var body = 'image=' + img + '&stick=' + stick;
               // request.addEventListener("load", function (event) {
                   // console.log(event.target.responseText);
            //   });
                request.send(body);
            };

    </script>

<!--if (overlay)-->
<!--{-->
<!--var image = canvas.toDataURL("image/png");-->
<!---->
<!--var xmlhttp = new XMLHttpRequest();-->
<!--var response = xmlhttp.responseText;-->
<!---->
<!--xmlhttp.onreadystatechange = function()-->
<!--{-->
<!--if (xmlhttp.readyState == 4 && xmlhttp.status == 200)-->
<!--{-->
<!--var response = xmlhttp.responseText;-->
<!--img.src = response;-->
<!--}-->
<!--};-->
<!--xmlhttp.open("POST", "compare.php", true);-->
<!--xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");-->
<!--xmlhttp.send("overlay=" + overlay.src + "&photo=" + image);-->
<!--}-->
<!--    <script>-->
<!--        const btn = document.getElementsByClassName('likes');-->
<!--        for (i=0;i<btn.length;i++)-->
<!--        {-->
<!--            btn[i].addEventListener('click', like, false);-->
<!--        };-->
<!--        function like(e) {-->
<!--            var item = this.getAttribute('id');-->
<!--            var body = "key=" + item;-->
<!--            var request = new XMLHttpRequest();-->
<!--            request.open("POST", "http://localhost:8082/likecounter", true);-->
<!--            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');-->
<!--            request.addEventListener("load", function(event) {-->
<!--                console.log(event.target.responseText);-->
<!--                var tmp = document.getElementById(item);-->
<!--                var likeAmount = event.target.responseText;-->
<!--                var oldLike = parseInt(tmp.nextElementSibling.innerHTML);-->
<!--                if (likeAmount - oldLike == 1)-->
<!--                    tmp.getElementsByTagName('img')[0].setAttribute('src', '/public/images/like1.png')-->
<!--                else-->
<!--                    tmp.getElementsByTagName('img')[0].setAttribute('src', '/public/images/like2.png')-->
<!--                tmp.nextElementSibling.innerHTML = likeAmount;-->
<!--            });-->
<!--            request.send(body);-->
<!--        };-->
<!--    </script>-->
<!--    <div id="stick" style="display: none">-->
<!--        <img width=40 height=60 src="/public/images/1.png">-->
<!--        <img width=40 height=60 src="/public/images/2.png">-->
<!--        <img width=40 height=60 src="/public/images/3.png">-->
<!--        <img width=60 height=140 src="/public/images/4.png">-->
<!--        <img width=60 height=140 src="/public/images/5.jpg">-->
<!--    </div>-->


<?php endif; ?>