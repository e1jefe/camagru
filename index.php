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
            <img src="/img/1a.jpg">
            <img src="/img/2a.jpg">
            <img src="/img/3a.jpg">
            <img src="/img/4a.jpg">
            <img src="/img/5a.jpg">
            <img src="/img/6a.jpg">
            <img src="/img/1a.jpg">
            <img src="/img/2a.jpg">
            <img src="/img/3a.jpg">
            <img src="/img/4a.jpg">
            <img src="/img/5a.jpg">
            <img src="/img/6a.jpg">
        </div>
    </div>

    <div class="right"></div>
</div>
<footer class="container">
    <div class="copyrights">
        <p>
            © 2018 Camagru. All rights reserved by dsheptun.
        </p>
    </div>
    <div class="btn-home">
        <a href="#home" onclick="up()">
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

<!--<video id="localVideo" autoplay muted></video>-->
<script>
    var photo = document.getElementsByClassName('btn-photo');
    photo[0].addEventListener('click', function () {
        var PeerConnection = window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
        navigator.getUserMedia = navigator.getUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia;

        navigator.getUserMedia(
            { audio: true, video: true },
            gotStream,
            function(error) { console.log(error) }
        );

        function gotStream(stream) {
            document.getElementById("localVideo").src = URL.createObjectURL(stream);

            pc = new PeerConnection(null);
            pc.addStream(stream);
            pc.onicecandidate = gotIceCandidate;
            pc.onaddstream = gotRemoteStream;
        }
    })


</script>

</body>
</html>