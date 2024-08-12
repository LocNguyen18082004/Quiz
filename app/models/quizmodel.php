<?php 

class quizmodel extends DModel {

    public function __construct()
    {
        parent::__construct();
    }
    //--------------------------------------------------------Admin---------------------------------------------
    
    public function insertQuestion($data) {
        return $this->db->insert('tbl_question', $data);
    }

    public function insertChoice($data) {
        return $this->db->insert('tbl_choice', $data);
    }

    public function insertAnswer($data) {
        return $this->db->insert('tbl_answer', $data);
    }
 
    public function deleteAnswer($table, $cond) {

        return $this->db->delete($table, $cond);
    }

    public function deleteChoice($table, $cond) {
        return $this->db->delete($table, $cond);
    }
    public function deleteQuestion($table, $cond) {
        return $this->db->delete($table, $cond);
    }
    public function questionselect($table, $cond) {
        $sql = "SELECT * FROM $table WHERE $cond";
        return $this->db->select($sql);
    }
    public function deleteQuestionn($id_question) {
        $table_question = "tbl_question";
        $cond_question = "id_question='$id_question'";
        return $this->db->delete($table_question, $cond_question);
    }
    public function updateQuizQuestionCount($quiz_id) {
        $table_question = "tbl_question";
        $cond_question = "id_quiz='$quiz_id'";
        
        // Đếm số lượng câu hỏi hiện có
        $sql = "SELECT COUNT(*) as total_questions FROM $table_question WHERE $cond_question";
        $result = $this->db->select($sql);
        
        if (!empty($result)) {
            $total_questions = $result[0]['total_questions'];
            
            // Cập nhật tổng số câu hỏi trong bảng tbl_quiz
            $table_quiz = "tbl_quiz";
            $data = array('total_questions' => $total_questions);
            $cond_quiz = "id_quiz='$quiz_id'";
            return $this->db->update($table_quiz, $data, $cond_quiz);
        } else {
            return false;
        }
    }
    public function deleteByQuestionId($table, $question_id) {
        $result = $this->db->delete($table, "id_question='$question_id'");
        error_log("Deleted from $table where id_question=$question_id. Result: " . ($result ? 'success' : 'fail'));
        return $result;
    }
    public function updateQuestion($question_id, $data) {
        $this->db->update('tbl_question', $data, "id_question='$question_id'");
    }
    
    // Lấy thông tin câu hỏi dựa trên ID câu hỏi
    public function getQuestionById($question_id) {
        $sql = "SELECT * FROM tbl_question WHERE id_question = :id_question";
        $data = array(':id_question' => $question_id);
        return $this->db->select($sql, $data)[0]; // Trả về kết quả đầu tiên
    }

    // Lấy các lựa chọn của câu hỏi dựa trên ID câu hỏi
    public function getChoicesByQuestionId($question_id) {
        $sql = "SELECT * FROM tbl_choice WHERE id_question = :id_question";
        $data = array(':id_question' => $question_id);
        return $this->db->select($sql, $data);
    }
    public function updateChoice($choice_id, $data) {
        return $this->db->update('tbl_choice', $data, "id_choice='$choice_id'");
    }
    
    public function updateOrInsertAnswer($data) {
        $existingAnswer = $this->db->select("SELECT * FROM tbl_answer WHERE id_question = '{$data['id_question']}'");
        if ($existingAnswer) {
            return $this->db->update('tbl_answer', $data, "id_question='{$data['id_question']}'");
        } else {
            return $this->db->insert('tbl_answer', $data);
        }
    }
    
    public function updateAnswerCorrectness($question_id, $choice_id, $is_correct) {
        $data = array('is_correct' => $is_correct);
        return $this->db->update('tbl_answer', $data, "id_question='$question_id' AND id_choice='$choice_id'");
    }
    
    public function getCorrectAnswerByQuestionId($question_id) {
        $sql = "SELECT c.id_choice, c.choice_text 
                FROM tbl_answer a 
                JOIN tbl_choice c ON a.id_choice = c.id_choice 
                WHERE a.id_question = :id_question AND a.is_correct = 1";
        $data = array(':id_question' => $question_id);
        $result = $this->db->select($sql, $data);
        return !empty($result) ? $result[0] : null;
    }

    //--------------------------------------------------------End Admin--------------------------------------




    //--------------------------------------------------------Home--------------------------------------------
    
    public function details_quiz_home($table,$table_quiz,$cond) {
        $sql = "SELECT * FROM $table_quiz, $table WHERE $cond";
        return $this->db->select($sql);
    }
    public function related_quiz_home($table,$table_quiz,$cond_related){
        $sql = "SELECT * FROM $table_quiz, $table WHERE $cond_related";
        return $this->db->select($sql);
    }

    public function getQuizzesByCategory($table_quiz, $id) {
        $sql = "SELECT * FROM $table_quiz WHERE id_category_quiz = '$id'";
        return $this->db->select($sql);
    }

   
    
    
}
    



?>