<?php 

    class usermodel extends DModel {
        public function __construct()
        {
            parent::__construct();
        }
        public function insertuser($table_user, $data){
            return $this->db->insert($table_user,$data);
        }
        public function login($table_user,$username,$password){
            $sql = "SELECT * FROM $table_user WHERE email=? AND password=? ";
            return $this->db->affectedRows($sql,$username,$password);
        }
        public function getLogin($table_user,$username,$password){
            $sql = "SELECT * FROM $table_user WHERE email=? AND password=? ";
            return $this->db->selectUser($sql,$username,$password);
        }
    }


?>