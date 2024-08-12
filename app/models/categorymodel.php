<?php 

class categorymodel extends DModel{

    public function __construct()
    {
        parent::__construct();
    }
    //---------------------------------------------------------------------- Danh mục Quiz-------------------------------------

    public function category($table){
        $sql = "SELECT * FROM $table ORDER BY id_category_quiz ASC";
        return $this->db->select($sql);

    }
    public function category_home($table){
        $sql = "SELECT * FROM $table ";
        return $this->db->select($sql);

    }
    public function categorybyid($table,$cond) {
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
        
    }
    public function insertcategory($table,$data){
        return $this->db->insert($table,$data);
    }
    public function deletecategory($table,$cond){
        return $this->db->delete($table,$cond);
    }
    public function updatecategory($table,$data,$cond){
        return $this->db->update($table,$data,$cond);
    }
    //---------------------------------------------------------------------phân trang Category-------------------------------------------

    public function list_product_home_paginate($table, $limit, $offset) {
        $sql = "SELECT * FROM $table ORDER BY id_category_quiz DESC LIMIT $limit OFFSET $offset";
        return $this->db->select($sql);
    }

    public function get_total_products($table) {
        $sql = "SELECT COUNT(*) as total FROM $table";
        return $this->db->select($sql)[0]['total'];
    }

    //----------------------------------------------------------------------Bài Quiz--------------------------------------------

    public function quiz($table_quiz,$table){
        $sql = "SELECT * FROM $table_quiz,$table WHERE $table_quiz.id_category_quiz=$table
        .id_category_quiz ORDER BY $table_quiz.id_quiz ASC";
        return $this->db->select($sql);

    }
    public function quizbyid($table, $cond) {
        // Lấy thông tin sản phẩm
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
    }
    public function insertquiz($table_quiz,$data){
        return $this->db->insert($table_quiz,$data);
        
    }
    public function deletequiz($table_quiz,$cond){
        return $this->db->delete($table_quiz,$cond);
    }
    public function updatequiz($table_quiz,$data,$cond){
        return $this->db->update($table_quiz,$data,$cond);
    }
    public function list_quiz_index($table_quiz) {
        $sql = "SELECT tbl_quiz.*, tbl_category_quiz.title_category_quiz
                FROM $table_quiz tbl_quiz
                JOIN tbl_category_quiz ON tbl_quiz.id_category_quiz = tbl_category_quiz.id_category_quiz";
        return $this->db->select($sql);
        
    }
    
        

    //---------------------------------------------------------------------phân trang Quiz-------------------------------------------
    public function list_quiz_paginater($table_quiz, $table, $limit, $offset) {
        $sql = "SELECT tbl_quiz.*, tbl_category_quiz.title_category_quiz 
        FROM $table_quiz 
        LEFT JOIN $table ON tbl_quiz.id_category_quiz = tbl_category_quiz.id_category_quiz 
        ORDER BY tbl_quiz.id_quiz DESC 
        LIMIT $limit OFFSET $offset";
        return $this->db->select($sql);
    }
    
    public function get_total_quiz($table_quiz) {
        $sql = "SELECT COUNT(*) as total FROM $table_quiz";
        return $this->db->select($sql)[0]['total'];
    }
    
    
    
    
    
}
?>