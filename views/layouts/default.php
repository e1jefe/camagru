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
            <a href="main/privacy">Privacy policy</a>
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