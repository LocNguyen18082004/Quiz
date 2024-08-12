<div class="container my-5" id="content">
    <div class="row">
        <div class="col text-center">
            <h2><i class="fas fa-clock" style="color: #23B5E1;"></i> <span id="timer"></span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card border-info">
                <div class="card-header text-white" style="background-color: #23B5E1;">
                    <span>Câu hỏi</span>
                    <span class="float-right badge badge-dark" style="padding: .28em .7em;">
                        <?php echo htmlspecialchars($question_number); ?>/<?php echo htmlspecialchars($total_questions); ?>
                    </span>
                </div>
                <div class="card-body">
                    <?php if (isset($current_question['question_text'])): ?>
                        <p class="card-text" style="font-weight: 500;">
                            <?php echo htmlspecialchars($current_question['question_text']); ?>
                        </p>
                        <hr>
                        <?php if (!empty($current_question['choices'])): ?>
                            <?php foreach ($current_question['choices'] as $choice): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" value="<?php echo htmlspecialchars($choice['id']); ?>" id="choice_<?php echo htmlspecialchars($choice['id']); ?>">
                                    <label class="form-check-label" for="choice_<?php echo htmlspecialchars($choice['id']); ?>">
                                        <?php echo htmlspecialchars($choice['choice_text']); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Không có lựa chọn nào.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted">Không có câu hỏi nào.</p>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="prevBtn" <?php echo ($_SESSION['current_question'] <= 0) ? 'disabled' : ''; ?>>Prev</button>
                    <button class="btn btn-primary" id="nextBtn" <?php echo ($_SESSION['current_question'] >= $total_questions - 1) ? 'disabled' : ''; ?>>Next</button>
                    <button class="btn btn-success" id="submitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    
    nextBtn.addEventListener('click', function() {
        const currentIndex = parseInt('<?php echo $_SESSION['current_question']; ?>');
        if (currentIndex < <?php echo count($_SESSION['questions']); ?> - 1) {
            window.location.href = "<?php echo BASE_URL; ?>/quiz_session/" + (currentIndex + 1);
        }
    });

    prevBtn.addEventListener('click', function() {
        const currentIndex = parseInt('<?php echo $_SESSION['current_question']; ?>');
        if (currentIndex > 0) {
            window.location.href = "<?php echo BASE_URL; ?>/quiz_session/" + (currentIndex - 1);
        }
    });
});
</script>
