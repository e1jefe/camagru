<?php include 'config.php'?>
<h3>Login/Sign-up</h3>
<form action="/account/login" method="post">
    <p> Login </p>
    <p><input type="text" name="login">
    <p>Password</p>
    <p><input type="text" name="password"></p>
    <b><button type="submit" name='enter'>Login</button></b>
    <a href=" https://www.facebook.com/v3.0/dialog/oauth?client_id=<?=ID?>&redirect_uri=<?=URL?>">Войти через ФБ</a>

</form>