<?php
namespace models;
use core\Model;
use Imagick;
use lib\Db;
class User extends Model
{
//    public $error;
//
//    public function loginValidate()
//    {
//        $config = require 'config/routes.php';
//        $connection = new Db;
//        $login1 = ($_POST['login']);
//        $pass1 = ($_POST['passwd']);
//        $login = $connection->row("SELECT * FROM users WHERE user_login= $login1");
//        $pass = $connection->row("SELECT * FROM users WHERE user_password= $pass1");
//        if ($login1 != $login or $pass1 != $pass) {
//            echo "<script>alert(\"Login or password incorrect\");</script>";
//            return false;
//        }
//        return true;
//    }
}