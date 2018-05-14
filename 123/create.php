<?php
//
//session_start();
//
//$file = 'user_base/passwd';
//if (file_exists($file) === FALSE)
//    mkdir('user_base');
//if ($_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['phone-nbr'] !== "" && $_POST['email'] !== "" && $_POST['name'] !== "" && $_POST['submit'] == 'OK')
//{
//    if (strlen($_POST['phone-nbr']) == 13 && strpos($_POST['phone-nbr'], "+380") !== FALSE)
//    {
//        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
//        {
//            if (ctype_alpha(str_replace(' ', '', $_POST['name'])))
//            {
//                $arr['login'] = $_POST['login'];
//                $arr['passwd'] = hash('whirlpool', $_POST['passwd']);
//                $arr['phone-nbr'] = $_POST['phone-nbr'];
//                $arr['email'] = $_POST['email'];
//                $arr['name'] = $_POST['name'];
//
//                $file_cont = unserialize(file_get_contents($file));
//                $error = -1;
//                foreach ($file_cont as $key => $value)
//                {
//                    if ($value['login'] === $_POST['login'])
//                        $error = 1;
//                }
//                if ($error === 1)
//                    $message = "This login has already taken. ";
//                else
//                {
//                    $file_cont[] = $arr;
//                    $message = "Your account is created. ";
//                    $_SESSION['loggued_on_user'] = $_POST['login'];
//                    $_SESSION['is_log'] = TRUE;
//                }
//                $serializedData = serialize($file_cont);
//                file_put_contents($file, $serializedData);
//            }
//            else
//            {
//                $message = "Only latin symbols. ";
//                $error = 1;
//            }
//        }
//        else
//        {
//            $message = "Invalid email format. ";
//            $error = 1;
//        }
//
//    }
//    else
//    {
//        $message = "Wrong phone number. ";
//        $error = 1;
//    }
//}
//else
//{
//    $message = "Please fill all fields. ";
//    $error = 1;
//    return ;
//}

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
    <link rel="stylesheet" href="css/style1.css">
    <style>
        body{
            background: #2c3e50; /* fallback for old browsers */
            background: -webkit-linear-gradient(right, #528354, #314e32);
            background: -moz-linear-gradient(right, #528354, #314e32);
            background: -o-linear-gradient(right, #528354, #314e32);
            background: linear-gradient(to left, #528354, #314e32);
            font-family: "MyriadPro", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .container {
            margin: 50px auto;
            padding: 10%;
        }
        .message {
            font-size: 50px;
            color: #fff;
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
<?php
Include "sign-in.php";
?>
<div class="container">
    <p class="message">
        <?php
        echo $message;
        if ($error === -1)
            header("refresh:3;url=newuser.php");
        else
            header("refresh:3;url=newuser.php");
        ?>
    </p>
</div>
</body>