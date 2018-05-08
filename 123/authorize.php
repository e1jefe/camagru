<?php

session_start();

function auth($login, $passwd)
{
    if ($login !== "" && $passwd !== "")
    {
        $file = 'user_base/passwd';
        $pass_hash = hash('whirlpool', $passwd);
        $file_cont = unserialize(file_get_contents($file));
        foreach ($file_cont as $key => $account)
        {
            if ($account['login'] === $login)
            {
                if ($account['passwd'] === $pass_hash)
                    return TRUE;
            }
        }
    }
    return FALSE;
}

$error = 0;
if (auth($_POST['login'], $_POST['passwd']) === TRUE)
{
    $_SESSION['loggued_on_user'] = $_POST['login'];
    $_SESSION['is_log'] = TRUE;
    if ($_SESSION['loggued_on_user'] === 'admin')
    {
        header("Location: admin.php");
        exit;
    }
    $message = "Your account is autorized.";
}
else
{
    $_SESSION['loggued_on_user'] = "";
    $_SESSION['is_log'] = FALSE;
    $message = "Wrong login or password. ";
    $error = 1;
}

?>

<html>
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
    <style>
        body{
            background: #F0FFFF; /* fallback for old browsers */
            font-family: "MyriadPro", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .container {
            margin: 50px auto;
            padding-top: 10%;
        }
        .message {
            font-size: 50px;
            color: #2c3e50;
            display: block;
            margin: 0 auto;
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #fff;
            font-style: italic;
        }
        a:hover, a:active {
            outline: none;
            background: rgba(0, 0, 0, 0.4);
            -moz-transition-property: rgba(0, 0, 0, 0.4); /*SMOOTH CHANGE BG FOR HOVER*/
            -moz-transition-duration: 0.8s;
            -moz-transition-timing-function: ease-out;
            -webkit-transition-property: rgba(0, 0, 0, 0.4);
            -webkit-transition-duration: 1s;
            -o-transition-property: rgba(0, 0, 0, 0.4);
            -o-transition-duration: 0.8s;
        }
    </style>
</head>
<body>
<div class="container">
    <p class="message">
        <?php
        if ($error !== 1)
        {
            echo $message;
            header("refresh:2;url=index.php");
        }
        else
        {
            echo $message;
            header("refresh:2;url=sign-in.php");
        }
        ?>
    </p>
</div>
</body>
</html>