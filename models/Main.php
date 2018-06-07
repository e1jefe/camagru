<?php
namespace models;
use core\Model;
use lib\Db;
class Main extends Model {
    public $error;
    public function contactValidate($post) {
        $nameLen = iconv_strlen($post['name']);
        $textLen = iconv_strlen($post['text']);
        if ($nameLen < 2 or $nameLen > 20) {
            $this->error = 'Имя должно содержать от 3 до 20 символов';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'E-mail указан неверно';
            return false;
        } elseif ($textLen < 10 or $textLen > 500) {
            $this->error = 'Сообщение должно содержать от 10 до 500 символов';
            return false;
        }
        return true;
    }
    public function picCount() {
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }
    public function picList($route) {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function getPics()
    {
         $user = $this->db->row("SELECT user_id FROM users WHERE user_login = :login", ['login' => $_SESSION['login']]);
         //die("<pre>" . print_r($user, true) . "</pre>");
         $pics = $this->db->row('SELECT source FROM pics');
         $likes = $this->db->row('SELECT likes FROM pics');
         $liked_photos = $this->db->row("
            SELECT source FROM pics 
            LEFT JOIN likes 
            ON pics.id_pic = likes.post_id
            WHERE likes.user_id = {$user[0]['user_id']}
         ");
         $liked_photos = array_column($liked_photos, 'source');
        $i = 0;
        while ($i < count($pics))
        {
            $posts[$pics[$i]['source']] = $likes[$i]['likes'];
            $i++;
        }
        return ['liked_photos' => $liked_photos, 'posts' => $posts];
    }
}