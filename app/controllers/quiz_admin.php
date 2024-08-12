<?php

class quiz_admin extends DController {
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->add_category();
    }
    //---------------------------------------------------Category QUIZ-------------------------------------------------
    public function add_category(){
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/Quiz/add_category_quiz');
        $this->load->view('admin/footer');
    }
    public function insert_category(){
        $title = $_POST['title_category_quiz'];
        $desc = $_POST['desc_category_quiz'];

        $table = "tbl_category_quiz";
        $data = array(
            'title_category_quiz' => $title,
            'desc_category_quiz' => $desc
        );
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->insertcategory($table,$data);
        if($result !== false){
            
            $message['msg'] = "Thêm danh mục sản phẩm thành công";
            header('Location:'.BASE_URL."/quiz_admin/add_category?msg=".urlencode(serialize($message)));
        }else{
            $message['msg'] = "Thêm danh mục sản phẩm thất bậi";
            header('Location:'.BASE_URL."/quiz_admin/add_category?msg=".urlencode(serialize($message)));
        }
    }
    public function list_category(){
        $this->load->view('admin/header');
        $this->load->view('admin/menu');

        $table = "tbl_category_quiz";

        $categorymodel = $this->load->model('categorymodel');
        $data['category'] = $categorymodel->category($table);

        $limit = 5; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $data['category'] = $categorymodel->list_product_home_paginate($table, $limit, $offset);
        $data['total_products'] = $categorymodel->get_total_products($table);
        $data['limit'] = $limit;
        $data['page'] = $page;

        $this->load->view('admin/Quiz/list_category_quiz', $data);
        $this->load->view('admin/footer');
    }

    public function delete_category($id){
        $table = "tbl_category_quiz";
        $cond = "id_category_quiz='$id'";
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->deletecategory($table,$cond);
        if($result==1){
            $message['msg'] = "Xóa danh mục Quiz thành công";
            header('Location:'.BASE_URL."/quiz_admin/list_category?msg=".urlencode(serialize($message)));
        }else{
            $message['msg'] = "Xóa danh mục Quiz thất bậi";
            header('Location:'.BASE_URL."/quiz_admin/list_category?msg=".urlencode(serialize($message)));
        }
    }

    public function edit_category($id){

        $table = "tbl_category_quiz";
        $cond = "id_category_quiz='$id'";
        $categorymodel = $this->load->model('categorymodel');
        $data['categorybyid'] = $categorymodel->categorybyid($table,$cond);

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/Quiz/edit_category_quiz',$data);
        $this->load->view('admin/footer');
    }
    public function update_category_quiz($id){
        $table = "tbl_category_quiz";
        $cond = "id_category_quiz='$id'";

        $title = $_POST['title_category_quiz'];
        $desc = $_POST['desc_category_quiz'];

        $data = array(
            'title_category_quiz' => $title,
            'desc_category_quiz' => $desc
        );
        $categorymodel = $this->load->model('categorymodel');

        $result = $categorymodel->updatecategory($table,$data,$cond);

        if($result==1){

            $message['msg'] = "Cập nhật danh mục sản phẩm thành công";
            header('Location:'.BASE_URL."/quiz_admin/list_category?msg=".urlencode(serialize($message)));
        }else{
            $message['msg'] = "Cập nhật danh mục sản phẩm thất bậi";
            header('Location:'.BASE_URL."/quiz_admin/list_category?msg=".urlencode(serialize($message)));
        }
    }

    //---------------------------------------------------QUIZ-------------------------------------------------

    public function add_quiz(){
        $this->load->view('admin/header');
        $this->load->view('admin/menu');

        $table = "tbl_category_quiz";
        $categorymodel = $this->load->model('categorymodel');
        $data['category'] = $categorymodel->category($table);

        $this->load->view('admin/Quiz/add_quiz', $data);
        $this->load->view('admin/footer');
    }
    public function insert_quiz() {
        $table_quiz = "tbl_quiz";
        $categorymodel = $this->load->model('categorymodel');
        $quizmodel = $this->load->model('quizmodel');
    
        $title = $_POST['title_quiz'];
        $code = $this->generateQuizCode(); // Tạo mã code tự động
        $desc = $_POST['desc_quiz'];
        $total_time = $_POST['total_time'];
        $category = $_POST['category_quiz'];
    
        $image = $_FILES['image_quiz']['name'];
        $tmp_image = $_FILES['image_quiz']['tmp_name'];
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;
        $path_uploads = "layout/uploads/quiz/".$unique_image;
    
        if ($image) {
            move_uploaded_file($tmp_image, $path_uploads);
        }
    
        // Tính tổng số câu hỏi
        $total_questions = count($_POST['questions']);
    
        $data = array(
            'title_quiz' => $title,
            'code_quiz' => $code,
            'desc_quiz' => $desc,
            'total_time' => $total_time,
            'id_category_quiz' => $category,
            'image_quiz' => $unique_image,
            'total_questions' => $total_questions
        );
    
        $quiz_id = $categorymodel->insertquiz($table_quiz, $data);
    
        if ($quiz_id) {
            foreach ($_POST['questions'] as $question) {
                $question_text = isset($question['question_text']) ? $question['question_text'] : '';
                $question_time = isset($question['time_per_question']) ? $question['time_per_question'] : 0;
                $question_data = array(
                    'question_text' => $question_text,
                    'id_quiz' => $quiz_id,
                    'time_per_question' => $question_time
                );
    
                $question_id = $quizmodel->insertQuestion($question_data);
    
                foreach ($question['choices'] as $choice_index => $choice) {
                    $choice_text = isset($choice['choice_text']) ? $choice['choice_text'] : '';
                    $choice_data = array(
                        'choice_text' => $choice_text,
                        'id_question' => $question_id
                    );
    
                    $choice_id = $quizmodel->insertChoice($choice_data);
    
                    $is_correct = ($choice_index == $question['correct_choice']) ? 1 : 0;
    
                    $answer_data = array(
                        'id_choice' => $choice_id,
                        'is_correct' => $is_correct,
                        'id_question' => $question_id
                    );
    
                    $quizmodel->insertAnswer($answer_data);
                }
            }
            $message['msg'] = "Thêm quiz thành công";
            header('Location:' . BASE_URL . "/quiz_admin/list_quiz?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Thêm quiz thất bại";
            header('Location:' . BASE_URL . "/quiz_admin/list_quiz?msg=" . urlencode(serialize($message)));
        }
    }
    
    private function generateQuizCode() {
        $prefix = 'QZ';
        $randomNumber = mt_rand(1000, 9999);
        return $prefix . $randomNumber;
    }
    
    
    public function list_quiz(){
        $this->load->view('admin/header');
        $this->load->view('admin/menu');

        $table_quiz = "tbl_quiz";
        $table = "tbl_category_quiz";

        $categorymodel = $this->load->model('categorymodel');
        $data['quiz'] = $categorymodel->quiz($table_quiz,$table);

        $limit = 5; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $data['quiz'] = $categorymodel->list_quiz_paginater($table_quiz, $table, $limit, $offset);
        $data['total_products'] = $categorymodel->get_total_quiz($table_quiz);
        $data['limit'] = $limit;
        $data['page'] = $page;


        $this->load->view('admin/Quiz/list_quiz', $data);
        $this->load->view('admin/footer');
    }
    public function delete_quiz($id) {
        $table_quiz = "tbl_quiz";
        $table_question = "tbl_question";
        $table_choice = "tbl_choice";
        $table_answer = "tbl_answer";
        
        $quizmodel = $this->load->model('quizmodel');
        $categorymodel = $this->load->model('categorymodel');
        
        // Xóa tất cả câu trả lời liên quan đến quiz
        $cond_answer = "id_question IN (SELECT id_question FROM $table_question WHERE id_quiz='$id')";
        $quizmodel->deleteAnswer($table_answer, $cond_answer);
        
        // Xóa tất cả các lựa chọn liên quan đến quiz
        $cond_choice = "id_question IN (SELECT id_question FROM $table_question WHERE id_quiz='$id')";
        $quizmodel->deleteChoice($table_choice, $cond_choice);
        
        // Xóa tất cả câu hỏi liên quan đến quiz
        $cond_question = "id_quiz='$id'";
        $quizmodel->deleteQuestion($table_question, $cond_question);
        
        // Xóa quiz
        $cond_quiz = "id_quiz='$id'";
        $result = $categorymodel->deletequiz($table_quiz, $cond_quiz);
        
        if ($result == 1) {
            $message['msg'] = "Xóa quiz thành công";
            header('Location:' . BASE_URL . "/quiz_admin/list_quiz?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Xóa quiz thất bại";
            header('Location:' . BASE_URL . "/quiz_admin/list_quiz?msg=" . urlencode(serialize($message)));
        }
    }
    
    public function edit_quiz($id){

        $table_quiz = "tbl_quiz";
        $table = "tbl_category_quiz";
        $cond = "id_quiz='$id'";
        $categorymodel = $this->load->model('categorymodel');

        $data['quizbyid'] = $categorymodel->quizbyid($table_quiz, $cond);
        $data['category'] = $categorymodel->category($table);

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/Quiz/edit_quiz', $data);
        $this->load->view('admin/footer');
    }
    public function update_quiz($id) {
        $table_quiz = "tbl_quiz";
        $cond = "id_quiz='$id'";
        $categorymodel = $this->load->model('categorymodel');
    
        $title = $_POST['title_quiz'];
        $total_time = $_POST['total_time'];
        $desc = $_POST['desc_quiz'];
        $category = $_POST['category_quiz'];
    
        $image = $_FILES['image_quiz']['name'];
        $tmp_image = $_FILES['image_quiz']['tmp_name'];
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;
        $path_uploads = "layout/uploads/Quiz/".$unique_image;
    
        $data = array(
            'title_quiz' => $title,
            'total_time' => $total_time,
            'desc_quiz' => $desc,
            'id_category_quiz' => $category
        );
    
        if ($image) {
            // Xóa ảnh cũ nếu có
            $existing_quiz = $categorymodel->quizbyid($table_quiz, $cond);
            if ($existing_quiz && $existing_quiz['image_quiz']) {
                $path_unlink = "layout/uploads/Quiz/";
                unlink($path_unlink.$existing_quiz['image_quiz']);
            }
    
            // Cập nhật ảnh mới
            move_uploaded_file($tmp_image, $path_uploads);
            $data['image_quiz'] = $unique_image;
        }
    
        $result = $categorymodel->updatequiz($table_quiz, $data, $cond);
        if ($result == 1) {
            $message['msg'] = "Cập nhật sản phẩm thành công";
            header('Location:'.BASE_URL."/quiz_admin/list_quiz?msg=".urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật sản phẩm thất bại";
            header('Location:'.BASE_URL."/quiz_admin/list_quiz?msg=".urlencode(serialize($message)));
        }
    }

    //------------------------------------------------------------Question-----------------------------------------------
    
    public function list_question($quiz_id) {
        $quizmodel = $this->load->model('quizmodel');
        
        // Lấy danh sách câu hỏi theo quiz_id
        $table_question = "tbl_question";
        $cond_question = "id_quiz='$quiz_id'";
        $questions = $quizmodel->questionselect($table_question, $cond_question);
        
        // Lấy danh sách lựa chọn cho mỗi câu hỏi và đáp án đúng
        foreach ($questions as &$question) {
            $question_id = $question['id_question'];
            
            // Lấy danh sách lựa chọn
            $table_choice = "tbl_choice";
            $cond_choice = "id_question='$question_id'";
            $choices = $quizmodel->questionselect($table_choice, $cond_choice);
            $question['choices'] = $choices;
            
            // Lấy đáp án đúng từ bảng tbl_answer
            $table_answer = "tbl_answer";
            $cond_answer = "id_question='$question_id' AND is_correct=1"; // is_correct=1 để xác định đáp án đúng
            $correct_answer = $quizmodel->questionselect($table_answer, $cond_answer);
            
            // Gán đáp án đúng cho câu hỏi
            if (!empty($correct_answer)) {
                // Lấy thông tin choice từ bảng tbl_choice
                $correct_choice_id = $correct_answer[0]['id_choice'];
                $table_choice = "tbl_choice";
                $cond_choice_correct = "id_choice='$correct_choice_id'";
                $correct_choice = $quizmodel->questionselect($table_choice, $cond_choice_correct);
                
                if (!empty($correct_choice)) {
                    $question['correct_answer'] = $correct_choice[0]['choice_text'];
                } else {
                    $question['correct_answer'] = 'Chưa có đáp án đúng';
                }
            } else {
                $question['correct_answer'] = 'Chưa có đáp án đúng';
            }
        }
        
        $data['questions'] = $questions;
        $data['quiz_id'] = $quiz_id;
    
        // Load các view
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/Quiz/list_question', $data);
        $this->load->view('admin/footer');
    }
    public function delete_question($id_question) {
        $quizmodel = $this->load->model('quizmodel');
        
        // Lấy quiz_id của câu hỏi cần xóa
        $table_question = "tbl_question";
        $cond_question = "id_question='$id_question'";
        $question = $quizmodel->questionselect($table_question, $cond_question);
        
        if ($question) {
            $quiz_id = $question[0]['id_quiz'];
            
            // Xóa câu hỏi
            $quizmodel->deleteQuestionn($id_question);
            
            // Cập nhật tổng số câu hỏi của quiz
            $quizmodel->updateQuizQuestionCount($quiz_id);
            
            // Chuyển hướng về trang danh sách câu hỏi
            $msg = urlencode(serialize(['msg' => 'Xóa câu hỏi thành công']));
            header("Location: " . BASE_URL . "/quiz_admin/list_question/$quiz_id?msg=$msg");
        } else {
            $msg = urlencode(serialize(['msg' => 'Câu hỏi không tồn tại']));
            header("Location: " . BASE_URL . "/quiz_admin/all_quiz?msg=$msg");
        }
    }
    public function add_question_form($quiz_id) {
        $data['quiz_id'] = $quiz_id;
    
        // Load các view
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/Quiz/add_question', $data);
        $this->load->view('admin/footer');
    }
    public function add_question() {
        $quizmodel = $this->load->model('quizmodel');
    
        if (isset($_POST['add_question'])) {
            $quiz_id = $_POST['id_quiz'];
            $question_text = $_POST['question_text'];
            $time_per_question = $_POST['time_per_question'];
            
            // Thêm câu hỏi vào bảng tbl_question
            $question_data = array(
                'question_text' => $question_text,
                'id_quiz' => $quiz_id,
                'time_per_question' => $time_per_question
            );
            $question_id = $quizmodel->insertQuestion($question_data);
    
            if ($question_id) {
                // Thêm các lựa chọn vào bảng tbl_choice
                $choices = isset($_POST['choices']) ? $_POST['choices'] : [];
                $correct_choice = isset($_POST['correct_choice']) ? $_POST['correct_choice'] : null;
    
                foreach ($choices as $index => $choice_text) {
                    $choice_data = array(
                        'choice_text' => $choice_text,
                        'id_question' => $question_id
                    );
                    $choice_id = $quizmodel->insertChoice($choice_data);
    
                    // Thêm đáp án đúng vào bảng tbl_answer
                    if ($index == $correct_choice) {
                        $answer_data = array(
                            'id_choice' => $choice_id,
                            'id_question' => $question_id,
                            'is_correct' => 1
                        );
                        $quizmodel->insertAnswer($answer_data);
                    }
                }
    
                // Cập nhật tổng số câu hỏi cho quiz
                $quizmodel->updateQuizQuestionCount($quiz_id);
    
                // Thông báo thêm câu hỏi thành công
                $message['msg'] = "Thêm câu hỏi thành công";
                header('Location: ' . BASE_URL . '/quiz_admin/list_question/' . $quiz_id . '?msg=' . urlencode(serialize($message)));
            } else {
                // Thông báo thêm câu hỏi thất bại
                $message['msg'] = "Thêm câu hỏi thất bại";
                header('Location: ' . BASE_URL . '/quiz_admin/list_question/' . $quiz_id . '?msg=' . urlencode(serialize($message)));
            }
        }
        
    }
    public function edit_question($question_id) {
        $quizmodel = $this->load->model('quizmodel');
    
        // Lấy thông tin câu hỏi
        $question = $quizmodel->getQuestionById($question_id);
        if (!$question) {
            // Xử lý trường hợp không tìm thấy câu hỏi
            $message = urlencode(serialize(["Không tìm thấy câu hỏi"]));
            header("Location: " . BASE_URL . "/quiz_admin/list_questions?msg=" . $message);
            exit();
        }
    
        // Lấy các lựa chọn của câu hỏi
        $choices = $quizmodel->getChoicesByQuestionId($question_id);
    
        // Lấy đáp án đúng
        $correct_answer = $quizmodel->getCorrectAnswerByQuestionId($question_id);
    
        // Chuẩn bị dữ liệu để gửi đến view
        $data = [
            'question' => $question,
            'choices' => $choices,
            'correct_answer' => $correct_answer,
            'id_quiz' => $question['id_quiz'] // Đảm bảo rằng bạn có trường này trong bảng question
        ];
    
        // Load view với dữ liệu
        $this->load->view('admin/header');
        $this->load->view('admin/Quiz/edit_question', $data);
        $this->load->view('admin/footer');
    }
    
    public function update_question() {
        $quizmodel = $this->load->model('quizmodel');
    
        if (isset($_POST['update_question'])) {
            $question_id = $_POST['id_question'];
            $quiz_id = $_POST['id_quiz'];
            $question_text = $_POST['question_text'];
            $time_per_question = $_POST['time_per_question'];
            $choices = isset($_POST['choices']) ? $_POST['choices'] : [];
            $correct_choice = isset($_POST['correct_choice']) ? $_POST['correct_choice'] : null;
          
    
            try {
                // Cập nhật câu hỏi
                $question_data = array(
                    'question_text' => $question_text,
                    'time_per_question' => $time_per_question
                );
                $quizmodel->updateQuestion($question_id, $question_data);
    
                // Lấy các lựa chọn hiện tại
                $currentChoices = $quizmodel->getChoicesByQuestionId($question_id);
    
                // Cập nhật hoặc thêm mới các lựa chọn
                foreach ($choices as $index => $choice_text) {
                    if (isset($currentChoices[$index])) {
                        // Cập nhật lựa chọn hiện có
                        $choice_data = array(
                            'choice_text' => $choice_text
                        );
                        $quizmodel->updateChoice($currentChoices[$index]['id_choice'], $choice_data);
                        $choice_id = $currentChoices[$index]['id_choice'];
                    } else {
                        // Thêm lựa chọn mới
                        $choice_data = array(
                            'choice_text' => $choice_text,
                            'id_question' => $question_id
                        );
                        $choice_id = $quizmodel->insertChoice($choice_data);
                    }
    
                    // Cập nhật đáp án đúng
                    if ($index == $correct_choice) {
                        $answer_data = array(
                            'id_choice' => $choice_id,
                            'id_question' => $question_id,
                            'is_correct' => 1
                        );
                        $quizmodel->updateOrInsertAnswer($answer_data);
                    } else {
                        // Đặt các đáp án khác là không đúng
                        $quizmodel->updateAnswerCorrectness($question_id, $choice_id, 0);
                    }
                }
    
                // Xóa các lựa chọn thừa (nếu có)
                for ($i = count($choices); $i < count($currentChoices); $i++) {
                    $quizmodel->deleteChoice('tbl_choice', "id_choice='{$currentChoices[$i]['id_choice']}'");
                    $quizmodel->deleteAnswer('tbl_answer', "id_choice='{$currentChoices[$i]['id_choice']}'");
                }
    
               
                
    
                $message = urlencode(serialize(["Cập nhật câu hỏi thành công"]));
                header("Location: " . BASE_URL . "/quiz_admin/list_question/" . $quiz_id . "?msg=" . $message);
                exit();
            }catch(Exception)  {

                $message = urlencode(serialize(["Có lỗi xảy ra khi cập nhật câu hỏi"]));
                header("Location: " . BASE_URL . "/quiz_admin/list_question/" . $quiz_id . "?msg=" . $message);
                exit();
            }
        }
    }
    
           
            //Header may not contain more than a single header, new line detected in C:\xampp\htdocs\Quiz_ASM\app\controllers\quiz_admin.php on line 531 
            //( Chịu :((((    )
} 
?>