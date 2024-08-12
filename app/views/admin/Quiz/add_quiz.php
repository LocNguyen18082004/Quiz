<div class="content">
    <div class="py-4 px-3 px-md-4">
        <div class="card mb-3 mb-md-4">
            <div style="font-size: 20px;" class="card-body">
                <nav class="d-none d-md-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Quiz</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm Bài Quiz</li>
                    </ol>
                </nav>
                <div class="mb-3 mb-md-4 d-flex justify-content-between">
                    <div class="h3 mb-0">Thêm Bài Quiz</div>
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


                <div>
                    <form action="<?php echo BASE_URL ?>/quiz_admin/insert_quiz" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <label for="name">Tên Quiz</label>
                                <input type="text" class="form-control" id="name" name="title_quiz" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="code_quiz">Mã Quiz</label>
                                <input type="text" class="form-control" id="code_quiz" name="code_quiz" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <label for="image_quiz">Hình ảnh Quiz</label>
                                <input type="file" class="form-control" id="image_quiz" name="image_quiz" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="desc_quiz">Mô tả quiz</label>
                                <input type="text" class="form-control" id="desc_quiz" name="desc_quiz" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <label for="total_time">Tổng thời gian (phút)</label>
                                <input type="number" class="form-control" id="total_time" name="total_time" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="category_quiz">Danh mục quiz</label>
                                <select class="form-control" id="category_quiz" name="category_quiz" required>
                                    <?php 
                                        foreach($category as $key => $cate){
                                    ?>
                                        <option value="<?php echo $cate['id_category_quiz']?>"> <?php echo $cate['title_category_quiz'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <h2>Câu hỏi và các lựa chọn</h2>
                                <div id="questions-container">
                                    <div class="question-block">
                                        <div class="form-group">
                                            <label for="question_text">Câu hỏi</label>
                                            <input type="text" class="form-control" name="questions[0][question_text]" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="time_per_question">Thời gian cho câu hỏi (giây)</label>
                                            <input type="number" class="form-control" name="questions[0][time_per_question]" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="choices">Các lựa chọn</label>
                                            <input type="text" class="form-control" name="questions[0][choices][0][choice_text]" placeholder="Lựa chọn A" required>
                                            <input type="text" class="form-control" name="questions[0][choices][1][choice_text]" placeholder="Lựa chọn B" required>
                                            <input type="text" class="form-control" name="questions[0][choices][2][choice_text]" placeholder="Lựa chọn C" required>
                                            <input type="text" class="form-control" name="questions[0][choices][3][choice_text]" placeholder="Lựa chọn D" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="correct_choice">Đáp án đúng</label>
                                            <select class="form-control" name="questions[0][correct_choice]" required>
                                                <option value="0">Lựa chọn A</option>
                                                <option value="1">Lựa chọn B</option>
                                                <option value="2">Lựa chọn C</option>
                                                <option value="3">Lựa chọn D</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-question-btn" class="btn btn-secondary mt-2">Thêm câu hỏi</button>
                            </div>
                        </div>

                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="randomPassword">
                            <label class="custom-control-label" for="randomPassword">Set Random</label>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Thêm Quiz</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeQuizInput = document.getElementById('code_quiz');
    codeQuizInput.value = generateQuizCode();

    const randomPasswordCheckbox = document.getElementById('randomPassword');
    randomPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            codeQuizInput.value = generateQuizCode();
        }
    });

    let questionIndex = 1;
    const addQuestionBtn = document.getElementById('add-question-btn');
    addQuestionBtn.addEventListener('click', function() {
        const questionsContainer = document.getElementById('questions-container');
        const newQuestionBlock = document.createElement('div');
        newQuestionBlock.classList.add('question-block');
        newQuestionBlock.innerHTML = `
            <div class="form-group">
                <label for="question_text">Câu hỏi</label>
                <input type="text" class="form-control" name="questions[${questionIndex}][question_text]" required>
            </div>
            <div class="form-group">
                <label for="time_per_question">Thời gian cho câu hỏi (giây)</label>
                <input type="number" class="form-control" name="questions[${questionIndex}][time_per_question]" required>
            </div>
            <div class="form-group">
                <label for="choices">Các lựa chọn</label>
                <input type="text" class="form-control" name="questions[${questionIndex}][choices][0][choice_text]" placeholder="Lựa chọn A" required>
                <input type="text" class="form-control" name="questions[${questionIndex}][choices][1][choice_text]" placeholder="Lựa chọn B" required>
                <input type="text" class="form-control" name="questions[${questionIndex}][choices][2][choice_text]" placeholder="Lựa chọn C" required>
                <input type="text" class="form-control" name="questions[${questionIndex}][choices][3][choice_text]" placeholder="Lựa chọn D" required>
            </div>
            <div class="form-group">
                <label for="correct_choice">Đáp án đúng</label>
                <select class="form-control" name="questions[${questionIndex}][correct_choice]" required>
                    <option value="0">Lựa chọn A</option>
                    <option value="1">Lựa chọn B</option>
                    <option value="2">Lựa chọn C</option>
                    <option value="3">Lựa chọn D</option>
                </select>
            </div>
        `;
        questionsContainer.appendChild(newQuestionBlock);
        questionIndex++;
    });
});

function generateQuizCode() {
    const prefix = 'QZ';
    const randomNumber = Math.floor(1000 + Math.random() * 9000);
    return prefix + randomNumber;
}
</script>
