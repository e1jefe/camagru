<?php

namespace models;

use core\Model;

class Main extends Model{

    public function getNews() {
 $result = $this->db->row('SELECT title, description FROM dbtest');
 return $result;
    }
}
