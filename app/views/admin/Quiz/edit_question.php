<div class="content">
    <div class="py-4 px-3 px-md-4">
        <div class="card mb-3 mb-md-4">
            <div style="font-size: 20px;" class="card-body">
                <nav class="d-none d-md-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Quiz</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa Câu Hỏi</li>
                    </ol>
                </nav>
                <div class="mb-3 mb-md-4 d-flex justify-content-between">
                    <div class="h3 mb-0">Chỉnh sửa Câu Hỏi</div>
                </div>

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

                <form action="<?php echo BASE_URL ?>/quiz_admin/update_question" method="post">
                    <input type="hidden" name="id_quiz" value="<?php echo htmlspecialchars($id_quiz); ?>">
                    <input type="hidden" name="id_question" value="<?php echo htmlspecialchars($question['id_question']); ?>">
                    
                    <div class="form-group">
                        <label for="question_text">Nội dung câu hỏi</label>
                        <textarea id="question_text" name="question_text" class="form-control" rows="3" required><?php echo htmlspecialchars($question['question_text']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="time_per_question">Thời gian cho câu hỏi (giây)</label>
                        <input type="number" id="time_per_question" name="time_per_question" class="form-control" value="<?php echo htmlspecialchars($question['time_per_question']); ?>" required>
                    </div>

                    <?php foreach ($choices as $index => $choice){ ?>
                        <div class="form-group">
                            <label for="choice<?php echo $index; ?>">Lựa chọn <?php echo $index + 1; ?></label>
                            <input type="text" id="choice<?php echo $index; ?>" name="choices[]" class="form-control" value="<?php echo htmlspecialchars($choice['choice_text']); ?>" required>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="correct_choice">Chọn đáp án đúng</label>
                        <select id="correct_choice" name="correct_choice" class="form-control" required>
                            <?php foreach ($choices as $index => $choice){ ?>
                                <option value="<?php echo $index; ?>" <?php echo ($correct_answer && $correct_answer['id_choice'] == $choice['id_choice']) ? 'selected' : ''; ?>>
                                    Lựa chọn <?php echo $index + 1; ?>
                                </option>
                            <?php }  ?>
                        </select>
                    </div>

                    <button type="submit" name="update_question" class="btn btn-primary">Cập Nhật Câu Hỏi</button>
                </form>
            </div>
        </div>
    </div>
</div>
