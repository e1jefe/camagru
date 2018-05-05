<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1><a href="index.php" class="ssilka">Camagru</a></h1>
    <nav><a href="http://instagram.com">Your page</a><a>Tralala</a><a href="authorize.php">login/signup</a></nav>
</header>
<div class="main">
    <div class="left">
        <div class="btn-photo">
            <a class="btn-photo" onclick="">
                <img src="/img/camera.png">
            </a>
        </div>
        <div class="btn-folder">
            <a>
                <label for="file-input">
                    <img src="/img/catalog.png"/>
                </label>

                <input id="file-input" style="display:none;" type="file"/>
            </a>
        </div>
    </div>
    <div class="middle">
        <div class="hovergallery">
            <img src="/img/1a.jpg">
            <img src="/img/2a.jpg">
            <img src="/img/3a.jpg">
            <img src="/img/4a.jpg">
            <img src="/img/5a.jpg">
            <img src="/img/6a.jpg">
            <img src="/img/7a.jpg">
            <img src="/img/8a.jpg">
            <img src="/img/9a.jpg">
            <img src="/img/10a.jpg">
            <img src="/img/11a.jpg">
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
<footer class="container">
    <div class="copyrights">
        <p>
            © 2018 Camagru. All rights reserved by dsheptun.
        </p>
    </div>
    <div class="btn-home">
        <a onclick="up()">
            <img src="img/arrow.png">
        </a>
    </div>

</footer>
<script type="text/javascript" charset="utf-8" async defer>
    var t;
    function up()
    {
        var top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        if(top > 0)
        {
            window.scrollBy(0, -80);
            t = setTimeout('up()', 10);
        }
        else
            clearTimeout(t);
    }
</script>

</body>
</html>