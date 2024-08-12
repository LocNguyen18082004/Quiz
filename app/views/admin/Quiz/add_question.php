<div class="content">
    <div class="py-4 px-3 px-md-4">
        <div class="card mb-3 mb-md-4">
            <div style="font-size: 20px;"  class="card-body">
                <!-- Breadcrumb -->
                <nav class="d-none d-md-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Quiz</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm Câu Hỏi</li>
                    </ol>
                </nav>
                <!-- End Breadcrumb -->
                <div class="mb-3 mb-md-4 d-flex justify-content-between">
                    <div class="h3 mb-0">Thêm Câu Hỏi Mới</div>
                </div>


                <!-- Hiển thị thông báo -->
                <?php 
                    if (!empty($_GET['msg'])) {
                        $msg = unserialize(urldecode($_GET['msg']));
                        foreach ($msg as $key => $value) {
                            echo '<div class="alert alert-success" role="alert">
                                    <span style="font-size:18px">'.$value.'</span>
                                  </div>';
                        }
                    }
                ?>

                <form action="<?php echo BASE_URL ?>/quiz_admin/add_question" method="post">
                    <input type="hidden" name="id_quiz" value="<?php echo $quiz_id; ?>">
                    <div class="form-group">
                        <label for="question_text">Nội dung câu hỏi</label>
                        <textarea id="question_text" name="question_text" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="time_per_question">Thời gian cho câu hỏi (giây)</label>
                        <input type="number" id="time_per_question" name="time_per_question" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="choice1">Lựa chọn 1</label>
                        <input type="text" id="choice1" name="choices[]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="choice2">Lựa chọn 2</label>
                        <input type="text" id="choice2" name="choices[]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="choice3">Lựa chọn 3</label>
                        <input type="text" id="choice3" name="choices[]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="choice4">Lựa chọn 4</label>
                        <input type="text" id="choice4" name="choices[]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correct_choice">Chọn đáp án đúng</label>
                        <select id="correct_choice" name="correct_choice" class="form-control" required>
                            <option value="0">Lựa chọn 1</option>
                            <option value="1">Lựa chọn 2</option>
                            <option value="2">Lựa chọn 3</option>
                            <option value="3">Lựa chọn 4</option>
                        </select>
                    </div>
                    <button type="submit" name="add_question" class="btn btn-primary">Thêm Câu Hỏi</button>
                </form>
            </div>
        </div>
    </div>
</div>
