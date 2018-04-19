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
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/authorization.css">
    <title>Fructo</title>
</head>
<?php
Include "header.php";
?>
<section class="login-page">
    <div class="form">
        <form class="login-form" action="authorise.php" method="post">
            <p class="register-form_title">
                Sign in
            </p>
            <input type="text" name="login" placeholder="username" value="" />
            <input type="password" name="passwd" placeholder="password" value="" />
            <button name="submit" value="OK" />login</button>
            <p class="message">Not registered? <a href="create1.php">Create an account</a></p>
        </form>
    </div>
</section>
</html>