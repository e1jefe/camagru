<?php
namespace controllers;
use core\Controller;
use models\Admin;
use lib\Db;
include ROOT.'/views/user/config.php';
class UserController extends Controller
{
    public function loginAction()
    {
        $this->view->render('login');
        $connection = new Db;
        if (isset($_POST['submit'])) {
            if (isset($_POST['login']) && isset($_POST['passwd'])) {

                $login = ($_POST['login']);
                $password = (hash('whirlpool', ($_POST['passwd'])));
                // делаем запрос к БД
                // и ищем юзера с таким логином и паролем
                $res = $connection->row("SELECT * FROM users WHERE user_login= '$login'");
                // if email not comfirmd
                if ($res == null) {
                    echo "<script>alert(\"no such login\");</script>";
                } else if ($res[0]['user_password'] != $password || $res[0]['email_confirmd'] == 0) {
                    echo "<script>alert(\"wrong pass or email didn't confirm\");</script>";
                } else {
                    $_SESSION['login'] = $login;
                    $this->view->redirect('');
                }
            }
            if (isset($_SESSION['login'])) {
                // показываем защищенные от гостей данные.
            } else
                die;
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['login']);
        $this->view->redirect('');
    }

    public function emailVerificationAction()
    {
        $this->view->render('login');
        $connection = new Db;
        $login = $_GET['login'];
        $token = $_GET['token'];
        $res = $connection->row("SELECT * FROM users WHERE user_login= '$login'");
        if ($res != null) {
            if ($res[0]['user_token'] == $token) {
                $connection->query("UPDATE users SET email_confirmd ='1' WHERE user_login='$login'");
            }
            echo "<script>alert(\"Email verified\");</script>";
            header("Refresh:2; login");
            exit();
        }
    }

    public function registrationAction()
    {
        $this->view->render('registration');
        $connection = new Db;

        if (isset($_POST['submit'])) {
            $err = array();
            $login = $_POST['login'];
            $email = $_POST['email'];
            # check login
            if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                echo "<script>alert(\"Enter latynic char and numbers only\");</script>";
                $err[] = "Enter latynic char and numbers only";
            }
            if (strlen($login) < 3 or strlen($login) > 30) {
                echo "<script>alert(\"Login must be more than 3 and less than 30 char\");</script>";
                $err[] = "Login must be more than 3 and less than 30 char";
            }
            if (strcmp($_POST['passwd'], $_POST['confpasswd'])) {
                $err[] = "Password does not match";
                echo "<script>alert(\"Password does not match\");</script>";
            }
            # check matching login
            $res = $connection->row("SELECT * FROM users WHERE user_login='$login'");
            $res2 = $connection->row("SELECT * FROM users WHERE email='$email'");
            if ($res != null || $res2 != null) {
                echo "<script>alert(\"User with this login/email already register\");</script>";
                $err[] = "User with this login/email already register";
            }
            # register if no err
            if (count($err) == 0) {
                $str = '1234567890qwertyuiopasdfghjklzxcvbnm1234567890qwertyuiopasdfghjklzxcvbnm';
                $str2 = str_shuffle($str);
                $token = substr($str2, 0, 7);
                if (mb_strlen($_POST['passwd']) >= 7 && mb_strlen($_POST['passwd']) < 20) {
                    $password = (hash('whirlpool', ($_POST['passwd'])));
                }
                $connection->query("INSERT INTO users (user_login, user_password, email, email_confirmd, user_token
)VALUES ('$login', '$password', '$email', 0, '$token')");
                //For sending mail
                $encoding = "utf-8";
                $mail_subject = "Verification";
                $from_name = "Camagru";
                $from_mail = "mail@camagru.dsheptun.live";
                // Set preferences for Subject field
                $subject_preferences = array(
                    "input-charset" => $encoding,
                    "output-charset" => $encoding,
                    "line-length" => 76,
                    "line-break-chars" => "\r\n"
                );
                // Set mail header
                $header = "Content-type: text/html; charset=" . $encoding . " \r\n";
                $header .= "From: " . $from_name . " <" . $from_mail . "> \r\n";
                $header .= "MIME-Version: 1.0 \r\n";
                $header .= "Content-Transfer-Encoding: 8bit \r\n";
                $header .= "Date: " . date("r (T)") . " \r\n";
                $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
                $mail_message = ' <!doctype html> <html>
                <p>Hi,</p>
                <p>Thanks for register.</p>
                <p>Pls, activate your account via this <a href="http://localhost:8082/user/emailVerification?login=' . $login . '&token=' . $token . '">link</a></p>
                <p>Best regards! Camagru team.</p>
                </html>';
                // Send mail
                mail($email, $mail_subject, $mail_message, $header);
                echo "<script>alert(\"Registration success, check your email\");</script>";
                header("Location: login");
                exit();
            } else
                echo "<script>alert(\"Password will be more than 7 characters\");</script>";
        }
    }

    public function passwordrecoveryAction()
    {
        $connection = new Db;
        $this->view->render('passwordrecovery');
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $res = $connection->row("SELECT * FROM users WHERE email='$email'");
            $str = '1234567890qwertyuiopasdfghjklzxcvbnm1234567890qwertyuiopasdfghjklzxcvbnm';
            $str2 = str_shuffle($str);
            $token = substr($str2, 0, 7);
            if ($email == $res[0]['email']) {
                $connection->query("UPDATE users SET user_token='$token' WHERE email= '$email'");
                $encoding = "utf-8";
                $mail_subject = "Recovery password";
                $from_name = "Camagru";
                $from_mail = "mail@camagru.dsheptun.live";
                // Set preferences for Subject field
                $subject_preferences = array(
                    "input-charset" => $encoding,
                    "output-charset" => $encoding,
                    "line-length" => 76,
                    "line-break-chars" => "\r\n"
                );
                // Set mail header
                $header = "Content-type: text/html; charset=" . $encoding . " \r\n";
                $header .= "From: " . $from_name . " <" . $from_mail . "> \r\n";
                $header .= "MIME-Version: 1.0 \r\n";
                $header .= "Content-Transfer-Encoding: 8bit \r\n";
                $header .= "Date: " . date("r (T)") . " \r\n";
                $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
                $mail_message = ' <!doctype html> <html>
                <p>Hi,</p>
                <p>Follow this <a href="http://localhost:8082/user/changepassmail?email=' . $email . '&token=' . $token . '">link</a> for recover password.</p>
                <p>If you did not want to change the password, ignore this email.</p>
                <p>Camagru support team.</p>
                </html>';
                // Send mail
                mail($email, $mail_subject, $mail_message, $header);
                echo "<script>alert(\"Check your mail\");</script>";
                header("Location: login");
                exit();
            } else
                echo "<script>alert(\"No one users with this email\");</script>";
        }
    }

    public function changepassmailAction()
    {
        $this->view->render('changepassmail');
        $connection = new Db;
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $token = $_POST['token'];
            if (mb_strlen($_POST['pass']) >= 7 && mb_strlen($_POST['pass']) < 20) {
                $pass = (hash('whirlpool', ($_POST['pass'])));
                $newpass = (hash('whirlpool', ($_POST['newpass'])));
                $res = $connection->row("SELECT * FROM users WHERE user_token= '$token'");
                if ($res != null) {
                    if ($res[0]['user_token'] == $token && $res[0]['email'] == $email) {
                        if ($pass == $newpass) {
                            $connection->query("UPDATE users SET user_password='$pass' WHERE email= '$email'");
                        } else {
                            echo "<script>alert(\"Password don't match\");</script>";
                        }
                    }
                    echo "<script>alert(\"Password changed\");</script>";
                    header("Refresh:2; login");
                    exit();
                } else
                    echo "<script>alert(\"Password will be more than 7 characters\");</script>";
            }
            echo "<script>alert(\"Enter password\");</script>";
        }
    }

    public function fbAction()
    {
        $connection = new Db;
        if ($_GET['code']) {
            $token = json_decode(file_get_contents('https://graph.facebook.com/v2.9/oauth/access_token?client_id=' . ID . '&redirect_uri=' . URL . '&client_secret=' . SECRET . '&code=' . $_GET['code']), true);
            $data = json_decode(file_get_contents('https://graph.facebook.com/v2.9/me?client_id=' . ID . '&redirect_uri=' . URL . '&client_secret=' . SECRET . '&code=' . $_GET['code'] . '&access_token=' . $token['access_token'] . '&fields=id,name,email,gender,location'), true);
            $res = $connection->row("SELECT * FROM users WHERE used_id");
            $id = $data['id'];
            $login = $data['name'];
            $email = $data['email'];
            if ($res['user_id'] == NULL) {
                $connection->query("INSERT INTO users (user_id, user_login, email, user_token)VALUES ('$id','$login','$email','FB')");
                $_SESSION['login'] = $login;
                $this->view->redirect('');
            } else if ($data['id'] == $res['user_id']) {
//                $_SESSION['login'] = $login;
                $_SESSION['login'] = $res[0]['user_login'];
                $this->view->redirect('');
            }
        }
    }

    public function accountAction()
    {

        $connection = new Db;
        $login = $_SESSION['login'];
        $res = $connection->row("SELECT * FROM users WHERE user_login='$login'");
        $this->view->render('account', $res[0]);
        if (isset($_POST['submit'])) {
            $log = ($_POST['login']);
            $connection->query("UPDATE users SET user_login='$log' WHERE user_id= {$res[0]['user_id']}");
            $_SESSION['login'] = $_POST['login'];
            header("Refresh:1; account");
        } else
            if (isset($_POST['submit1'])) {
                $email = ($_POST['email']);
                $connection->query("UPDATE users SET email='$email' WHERE user_id= {$res[0]['user_id']}");
                header("Refresh:1; account");
            }
    }

    public function changepassAction()
    {
        $this->view->render('changepass');
        $connection = new Db;
        $login = $_SESSION['login'];
        if (isset($_POST['submit'])) {
            if (mb_strlen($_POST['pass']) >= 7 && mb_strlen($_POST['pass']) < 20) {
                $pas = (hash('whirlpool', ($_POST['passwd'])));
                $pass = (hash('whirlpool', ($_POST['pass'])));
                $newpass = (hash('whirlpool', ($_POST['newpass'])));
                $res = $connection->row("SELECT * FROM users WHERE user_login= '$login'");
                $pasw = $res[0]['user_password'];
                if ($pas == $pasw) {
                    if ($pass == $newpass) {
                        $connection->query("UPDATE users SET user_password='$pass' WHERE user_id= {$res[0]['user_id']}");
                    } else {
                        echo "<script>alert(\"Password don't match\");</script>";
                    }
                    echo "<script>alert(\"Password changed\");</script>";
//                        exit();
                    header("Location: account");
                }
                echo "<script>alert(\"Wrong password\");</script>";
            }
            echo "<script>alert(\"Password will be more than 7 characters\");</script>";
        }
    }

    public function uploadphotoAction()
    {
        $connection = new Db;
        $uploaddir = '/Users/dsheptun/proverki/cam/public/images/'; // это папка, в которую будет загружаться картинка
        $dir = '/public/images/';
        $apend=date('YmdHis').rand(100,1000).'.jpg';
        $uploadfile = $uploaddir . $apend;
        if (isset($_FILES['userfile'])) {
            if ($_FILES['userfile']['size'] != 0 and $_FILES['userfile']['size'] <= 1024000) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                    $size = getimagesize($uploadfile);
                    if ($size[0] < 1200 && $size[1] < 5001) {
                        $connection->query("INSERT INTO pics (source, user_id, likes, comments)VALUES ('$dir$apend','1','0','')");
                        echo "<script>alert(\"Photo uploaded\");</script>";
                        header("Location: http://localhost:8082");
                        exit;
                    } else {
                        echo "<script>alert(\"Размер пикселей превышает допустимые нормы (ширина не более - 600 пикселей, высота не более 5000)\");</script>";
                        unlink($uploadfile);
                    }
                }
            }
            else {  echo "<script>alert(\"Размер файла не должен превышать 1000Кб\");</script>";}
        }
        else if(isset($_POST['image'])){
            $img = str_replace('data:image/png;base64,', '', $_POST['image']);
            $img = str_replace(' ', '+', $img);
            $img = base64_decode($img);
            $myfile = fopen($uploadfile, 'x');
            fwrite($myfile, $img);
            $connection->query("INSERT INTO pics (source, user_id, likes, comments)VALUES ('$dir$apend','1','0','')");
            fclose($myfile);
            header("Location: http://localhost:8082");
        } else {echo "<script>alert(\"Файл не загружен, вернитеcь и попробуйте еще раз\");</script>";}
    }

    public function likecounterAction(){
        $connection = new Db;
        $picLink = $_POST['key'];
        $tmp = $connection->row("SELECT * FROM pics WHERE source='$picLink'");
        $likeAmount = $tmp[0]['likes'];
        $pic_id = $tmp[0]['id_pic'];
        $likeArr = $connection->row("SELECT * FROM likes WHERE post_id='$pic_id'");
        $login = $_SESSION['login'];
        $res = $connection->row("SELECT user_id FROM users WHERE user_login= '$login'");
        $user_id = $res[0]['user_id'];
        $error = true;
        if ($likeArr != null) {
            foreach ($likeArr as $like) {
                if ($like['user_id'] == $user_id AND $like['post_id'] == $pic_id) {
                    $error = false;
                }
            }
        }
            if ($error == true) //ne bylo usera +1 like k pikche
            {
                $connection->query("INSERT INTO likes (post_id, user_id)VALUES ('$pic_id', '$user_id')");
                $connection->query("UPDATE pics SET likes={$tmp[0]['likes']} + 1  WHERE id_pic= '$pic_id'");
            }
            else //nado udalit iz like i -1 k pikche
            {
                $connection->query("DELETE FROM likes WHERE user_id='$user_id' AND post_id='$pic_id'");
              $connection->query("UPDATE pics SET likes={$tmp[0]['likes']} - 1  WHERE id_pic= $pic_id");
            }
        $tmp = $connection->row("SELECT * FROM pics WHERE source='$picLink'");
        echo $tmp[0]['likes'];
    }

}


