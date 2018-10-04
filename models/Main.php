<?php
namespace models;
use core\Model;
use lib\Db;
class Main extends Model
{
    public $error;

    public function picCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function getPics()
    {
        if (isset($_SESSION['login'])) {
            $user = $this->db->row("SELECT user_id FROM users 
                                      WHERE user_login = :login", ['login' => $_SESSION['login']]);
        }
        $pics = $this->db->row("
            SELECT pics.id_pic, pics.source, pics.likes, users.user_login, users.user_id FROM pics
            LEFT JOIN users
            ON pics.user_id = users.user_id
            ORDER BY pics.id_pic DESC
        ");
        if (isset($_SESSION['login'])) {
            $liked_photos = $this->db->row("
            SELECT pics.id_pic FROM pics 
            LEFT JOIN likes 
            ON pics.id_pic = likes.post_id
            WHERE likes.user_id = {$user[0]['user_id']}
         ");
            $comment = $this->db->row("SELECT * FROM comments ");


            $liked_photos = array_column($liked_photos, 'id_pic');
        }
        if (isset($_SESSION['login'])) {
            return ['comment' => $comment, 'liked_photos' => $liked_photos, 'posts' => $pics];
        }
        else
            return ['posts' => $pics];
    }
}
