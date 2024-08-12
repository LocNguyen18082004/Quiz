<?php 

    class index extends DController {

        public function __construct(){
            $data = array();
            parent::__construct();
        }
        public function index(){
            $this->home();
        }
        public function home(){
            $this->load->view('header');
            $this->load->view('home');
            $this->load->view('footer');
        }
        public function subject(){
            $table = 'tbl_category_quiz';
            $table_quiz = 'tbl_quiz';

            $categorymodel = $this->load->model('categorymodel');
            $data['quizindex'] = $categorymodel->list_quiz_index($table_quiz);
            
            $data['category'] = $categorymodel->category_home($table);

            $this->load->view('header');
            $this->load->view('subject', $data);
            $this->load->view('footer');
        }
        public function subject_category($id) {
            $table = 'tbl_category_quiz';
            $table_quiz = 'tbl_quiz';
            $data['category'] = $this->load->model('categorymodel')->category_home($table);
            $data['quizindex'] = $this->load->model('quizmodel')->getQuizzesByCategory($table_quiz, $id);
    
            $this->load->view('header');
            $this->load->view('category_quiz', $data); // Trang danh mục môn học
            $this->load->view('footer');
        }
        
    }

?>