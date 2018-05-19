<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
    <link rel="stylesheet" href="../public/styles/style.css">
</head>
<body>
<header>
    <h1><a href="/" class="ssilka">Camagru</a></h1>
    <nav><a href="http://instagram.com">Your page</a><a>Tralala</a>
        <?php if(isset($_SESSION['login'])): ?>
            <a href="">
                <?php echo $_SESSION['login']?>
            </a>
            <a href="user/logout">
                Logout
            </a>
        <?php else: ?>
            <a href="user/login">login/signup</a>
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
        <a onclick="up()">
            <img src="/public/images/arrow.png">
        </a>
    </div>
</footer>
</body>
</html>