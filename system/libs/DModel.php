<?php

class DModel{

    protected $db = array();

    public function __construct(){

        $connect = 'mysql:dbname=quiz_ASM; host=localhost; charset=utf8';
        $user = 'root';
        $pass = '';
        $this->db = new Database($connect,$user,$pass);
      }
}
?>