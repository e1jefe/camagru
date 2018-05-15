<?php
namespace controllers;
use core\Controller;
use models\Admin;
class UserController extends Controller {
    public function loginAction(){
        $this->view->layout = 'user';
        $this->view->render('Login');

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

}

?>
    }
}