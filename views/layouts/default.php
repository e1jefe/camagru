<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="shortcut icon" href="/public/images/favico.ico" type="image/x-icon">
</head>
<body>
<header>
    <h1><a href="/" class="ssilka">Camagru</a></h1>
    <nav>
        <?php if(isset($_SESSION['login'])): ?>
            <a>Hi,</a>
            <a href="https://camagru.dsheptun.live/user/account">
                <b>
                <?php echo $_SESSION['login']?>
                </b>
            </a>
            <a href="https://camagru.dsheptun.live/user/logout">
                Logout
            </a>
        <?php else: ?>
            <a href="https://camagru.dsheptun.live/user/login">Log in</a>
        <?php endif; ?>
    </nav>
</header>
<?php echo $content; ?>
<footer class="container">
    <div class="copyrights">
        <p>
            © 2018 Camagru. All rights reserved by dsheptun.
            <a href="https://camagru.dsheptun.live/main/privacy">Privacy policy</a>
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