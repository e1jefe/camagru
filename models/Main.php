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
        if(isset($_SESSION['login'])) {
            $user = $this->db->row("SELECT user_id FROM users 
                                      WHERE user_login = :login", ['login' => $_SESSION['login']]);
        }
        $pics = $this->db->row('SELECT source FROM pics ORDER BY id_pic DESC');
        $likes = $this->db->row('SELECT likes FROM pics ORDER BY id_pic DESC');
            $liked_photos = $this->db->row("
            SELECT source FROM pics 
            LEFT JOIN likes 
            ON pics.id_pic = likes.post_id
            WHERE likes.user_id = {$user[0]['user_id']}
         ");
            $liked_photos = array_column($liked_photos, 'source');

            $i = 0;
            while ($i < count($pics)) {
                $posts[$pics[$i]['source']] = $likes[$i]['likes'];
                $i++;
            }
            return ['liked_photos' => $liked_photos, 'posts' => $posts];
        }
}