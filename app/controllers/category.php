<?php 

class category extends DController {

    public function __construct(){
        $data = array();
        $message = array();
        parent::__construct();
    }
    public function list_category(){

        $this->load->view('header');

        $categorymodel = $this->load->model('categorymodel');

        $table = 'tbl_category_product';
        $data['category'] = $categorymodel->category($table);

        $this->load->view('category', $data);
        $this->load->view('footer');
    }

}
?>