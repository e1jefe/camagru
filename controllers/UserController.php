<?php
namespace controllers;
use core\Controller;
use models\Admin;
use lib\Db;
class UserController extends Controller
{
    public function loginAction()
    {
        $this->view->layout = 'user';
        $this->view->render('Login');
        $connection = new Db;
        if (isset($_POST['login']) && isset($_POST['passwd'])) {

            $login = ($_POST['login']);
            $password = (hash('whirlpool', ($_POST['passwd'])));

            // делаем запрос к БД
            // и ищем юзера с таким логином и паролем

            $query = $connection->query("SELECT `id` FROM `users` WHERE `user_login`='{$login}' AND `user_password`='{$password}' LIMIT 1");


            // если такой пользователь нашелся
            if (mysql_num_rows($sql) == 1) {
                // то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)

                $row = mysql_fetch_assoc($sql);
                $_SESSION['user_id'] = $row['id'];

                // не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
            } else {
                die('Login not found');
            }
        }

        if (isset($_SESSION['user_id'])) {
            // показываем защищенные от гостей данные.
        } else {
            die('Access denied.');
        }
    }

    public function emailVerificationAction()
    {
        $this->view->layout = 'user';
        $this->view->render('Login');
        $connection = new Db;
        $login = $_GET['login'];
        $token = $_GET['token'];
        $res = $connection->row("SELECT * FROM users WHERE user_login= '$login'");
        if ($res != null){
           if ($res[0]['user_token'] == $token)
            {
                $connection->query("UPDATE users SET email_confirmd ='1' WHERE user_login='$login'");
            }
            echo "<script>alert(\"Email verified\");</script>";
            header("Refresh:2; login"); exit();
        }
    }

    public function registrationAction()
    {
        $this->view->layout = 'user';
        $this->view->render('registration');
        $connection = new Db;

        if(isset($_POST['submit']))
        {
            $err = array();
            $login = $_POST['login'];
            $email = $_POST['email'];
            # check login
            if(!preg_match("/^[a-zA-Z0-9]+$/", $login))
            {
                $err[] = "Enter latynic char and numbers only";
            }

            if(strlen($login) < 3 or strlen($login) > 30)
            {
                echo "<script>alert(\"Login must be more than 3 and less than 30 char\");</script>";
                $err[] = "Login must be more than 3 and less than 30 char";
            }
            if(strcmp($_POST['passwd'], $_POST['confpasswd'] ))
            {
                $err[] = "Password does not match";
                echo "<script>alert(\"Password does not match\");</script>";

            }
            # check matching login
            $res = $connection->row("SELECT * FROM users WHERE user_login='$login'");
            $res2 = $connection->row("SELECT * FROM users WHERE email='$email'");

            //$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."'");
            if($res != null || $res2 != null)
            {
                echo "<script>alert(\"User with this login/email already register\");</script>";
                $err[] = "User with this login/email already register";
            }

            # register if no err
            if(count($err) == 0)
            {
                $str = '1234567890qwertyuiopasdf';
                $str2 = str_shuffle($str);
                $token = substr($str2, 0, 7);
                $password = (hash('whirlpool', ($_POST['password'])));
                $connection->query("INSERT INTO users (user_login, user_password, email, email_confirmd, user_token
)
VALUES ('$login', '$password', '$email', 0, '$token')");

                //For sending mail
                $encoding = "utf-8";
                $mail_subject = "Verification";
                $from_name = "Camagru";
                $from_mail = "dsheptun@student.unit.ua";

                // Set preferences for Subject field
                $subject_preferences = array(
                    "input-charset" => $encoding,
                    "output-charset" => $encoding,
                    "line-length" => 76,
                    "line-break-chars" => "\r\n"
                );

                // Set mail header
                $header = "Content-type: text/html; charset=".$encoding." \r\n";
                $header .= "From: ".$from_name." <".$from_mail."> \r\n";
                $header .= "MIME-Version: 1.0 \r\n";
                $header .= "Content-Transfer-Encoding: 8bit \r\n";
                $header .= "Date: ".date("r (T)")." \r\n";
                $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

                $mail_message = '<html>
                <p>Hi,</p>
                <p>Thanks for register.</p>
                <p>Pls, activate your account via this <a href="http://localhost:8082/user/emailVerification?login='.$login.'&token='.$token.'">link</a></p>
                <p>Best regards! Camagru team.</p>
                </html>'
                ;

                // Send mail
                mail($email, $mail_subject, $mail_message, $header);
                echo "<script>alert(\"Registration success, check your email\");</script>";
                header("Location: login"); exit();
            }
            else
            {
                print "<b>Error registration:</b><br>";
                foreach($err AS $error)
                {
                    print $error."<br>";
                }
            }
        }

    }
}