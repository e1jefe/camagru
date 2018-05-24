<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon">
</head>
<body>
<!--<script>-->
<!--    window.fbAsyncInit = function() {-->
<!--        FB.init({-->
<!--            appId      : '778480969008807',-->
<!--            cookie     : true,-->
<!--            xfbml      : true,-->
<!--            version    : 'v3.0'-->
<!--        });-->
<!---->
<!--        FB.AppEvents.logPageView();-->
<!---->
<!--    };-->
<!---->
<!--    (function(d, s, id){-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) {return;}-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = "https://connect.facebook.net/en_US/sdk.js";-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));-->
<!--</script>-->
<header>
    <h1><a href="/" class="ssilka">Camagru</a></h1>
    <nav>
        <?php if(isset($_SESSION['login'])): ?>
            <a>Your account:</a>
            <a href="">
                <?php echo $_SESSION['login']?>
            </a>
            <a href="user/logout">
                Logout
            </a>
        <?php else: ?>
            <a href="user/login">login / sign up</a>
        <?php endif; ?>
    </nav>
</header>
<?php echo $content; ?>
<footer class="container">
    <div class="copyrights">
        <p>
            © 2018 Camagru. All rights reserved by dsheptun.
        </p>
    </div>
    <div class="btn-home">
        <a href="javascript:scroll(0,0)" >
            <img src="/public/images/arrow.png">
        </a>
    </div>
</footer>
</body>
</html>