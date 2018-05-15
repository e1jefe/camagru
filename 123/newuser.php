<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="
		width=device-width,
		height=device-height,
		initial-scale=1,
		minimum-scale=1,
		maximum-scale=1,
		user-scalable=0"/>
    <link rel="stylesheet" href="../public/styles/fonts.css">
    <link rel="stylesheet" href="../public/styles/style1.css">
    <link rel="stylesheet" href="css/authorization.css">
    <title>Camagru</title>
</head>
<?php
Include "header.php";
?>
<section class="login-page">
    <div class="form">
        <form class="register-form" action="create.php" method="post">
            <p class="register-form_title">
                Create an account
            </p>
            <input type="text" name="login" placeholder="username" value="" />
            <input type="password" name="passwd" placeholder="password" value=""/>
            <input type="phone" name="phone-nbr" placeholder="+380*******" value=""/>
            <input type="email" name="email" placeholder="email" value=""/>
            <input type="text" name="name" placeholder="Name: only latin letters" value=""/>
            <button name="submit" value="OK" />create</button>
            <p class="message">Already registered? <a href="sign-in.php">Sign In</a></p>
        </form>
    </div>
</section>
</html>