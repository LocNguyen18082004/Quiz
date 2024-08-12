<?php 
    class quiz extends DController {

        public function __construct(){
            $data = array();
            parent::__construct();
        }

        public function details_subject($id){
            $table = 'tbl_category_quiz';
            $table_quiz = 'tbl_quiz';
            $cond = "$table_quiz.id_category_quiz=$table.id_category_quiz AND $table_quiz.id_quiz='$id'";
            $quizmodel = $this->load->model('quizmodel');
            

            $data['details_quiz'] = $quizmodel->details_quiz_home($table,$table_quiz,$cond);
            foreach($data['details_quiz'] as $key => $cate){
                $id_cate = $cate['id_category_quiz'];
            }
        
            $cond_related = "$table_quiz.id_category_quiz=$table.id_category_quiz AND $table.id_category_quiz='$id_cate'
            AND $table_quiz.id_quiz NOT IN ('$id')";
            $data['related'] = $quizmodel->related_quiz_home($table,$table_quiz,$cond_related);

            $this->load->view('header');
            $this->load->view('details_subject', $data);
            $this->load->view('footer');
        }
        public function quiz_session($question_index = null) {
            session::init(); // Khởi tạo session
        
            // Kiểm tra nếu không có chỉ số câu hỏi, sử dụng giá trị từ session
            if ($question_index === null) {
                $question_index = isset($_SESSION['current_question']) ? $_SESSION['current_question'] : 0;
            } else {
                $question_index = intval($question_index);
            }
        
            // Debug: Kiểm tra nội dung của $_SESSION['questions']
            if (isset($_SESSION['questions'])) {
                error_log(print_r($_SESSION['questions'], true));
            } else {
                error_log('$_SESSION[\'questions\'] is not set');
            }
        
            // Đảm bảo rằng chỉ số câu hỏi hợp lệ
            if (!isset($_SESSION['questions']) || !array_key_exists($question_index, $_SESSION['questions'])) {
                // Xử lý lỗi nếu câu hỏi không tồn tại
                $_SESSION['message'] = "Câu hỏi không tồn tại!";
                header("Location: " . BASE_URL);
                exit();
            }
        
            // Cập nhật chỉ số câu hỏi trong session
            $_SESSION['current_question'] = $question_index;
        
            $data = array();
            $data['current_question'] = $_SESSION['questions'][$question_index];
            $data['question_number'] = $question_index + 1;
            $data['total_questions'] = count($_SESSION['questions']);
            $data['time_left'] = $_SESSION['end_time'] - time();
        
            $this->load->view('header');
            $this->load->view('quiz_session', $data);
            $this->load->view('footer');
        }
        public function load_questions() {
            session::init(); // Khởi tạo session
            
            $quizmodel = $this->load->model('quizmodel');
            // Lấy câu hỏi từ cơ sở dữ liệu và lưu vào session
            $questions = $quizmodel->get_all_questions(); // Giả sử bạn có phương thức get_all_questions()
            $_SESSION['questions'] = $questions;
            $_SESSION['current_question'] = 0; // Bắt đầu từ câu hỏi đầu tiên
            $_SESSION['end_time'] = time() + 3600; // Ví dụ: thời gian kết thúc là 1 giờ sau
        }
        
        
        
      
    }
?>

