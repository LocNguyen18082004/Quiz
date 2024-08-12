<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <?php foreach($details_quiz as $key => $details){ ?>
                <div class="quiz-detail">
                    <img src="<?php echo BASE_URL ?>/layout/uploads/quiz/<?php echo $details['image_quiz']; ?>" alt="Quiz Image" class="img-fluid mb-3" />
                    <h2 class="quiz-title"><?php echo $details['title_quiz']; ?></h2>
                    <p><strong>Mã Quiz:</strong> <?php echo $details['code_quiz']; ?></p>
                    <p><strong>Tổng số câu hỏi:</strong> <?php echo $details['total_questions']; ?> (Câu)</p>
                    <p><strong>Mô tả:</strong> <?php echo $details['desc_quiz']; ?></p>
                    <p><strong>Tổng thời gian:</strong> <?php echo $details['total_time']; ?> (Phút)</p>
                    <a href="<?php echo BASE_URL ?>/quiz/quiz_session/<?php echo $details['id_quiz'] ?>" class="btn btn-primary">Bắt đầu làm bài</a>
                </div>
            <?php } ?>
            
            <!-- Bình luận -->
            <div class="comments mt-5">
                <h3>Bình luận</h3>
                <div class="comment-list">
                    <?php foreach($comments as $comment) { ?>
                    <div class="comment">
                        <p><strong><?php echo $comment['username']; ?>:</strong> <?php echo $comment['content']; ?></p>
                        <p><small>Ngày đăng: <?php echo $comment['date']; ?></small></p>
                    </div>
                    <?php } ?>
                </div>
                
                <!-- Form bình luận -->
                <form action="<?php echo BASE_URL ?>/quiz/comment" method="POST" class="mt-3">
                    <div class="form-group">
                        <label for="comment">Thêm bình luận:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Gửi</button>
                </form>
            </div>
        </div>

        <!-- Các bài quiz liên quan -->
        <div class="col-md-4">
            <div class="related-quizzes">
                <h4>Các bài quiz liên quan</h4>
                <ul class="list-unstyled">
                    <?php foreach($related as $related_quiz) { ?>
                    <li class="mb-3">
                        <div class="related-quiz-item">
                            <!-- Hình ảnh của quiz liên quan -->
                            <img src="<?php echo BASE_URL ?>/layout/uploads/quiz/<?php echo $related_quiz['image_quiz']; ?>" alt="Quiz Image" class="img-fluid mb-2" style="width: 100px; height: 100px;" />
                            
                            <!-- Tên quiz -->
                            <h5 class="quiz-title mb-1">
                                <a href="<?php echo BASE_URL ?>/quiz/details_subject/<?php echo $related_quiz['id_quiz'] ?>">
                                    <?php echo $related_quiz['title_quiz']; ?>
                                </a>
                            </h5>

                            <!-- Mã quiz -->
                            <p class="quiz-code mb-1"><strong>Mã Quiz:</strong> <?php echo $related_quiz['code_quiz']; ?></p>

                            <!-- Tổng thời gian quiz -->
                            <p class="quiz-time"><strong>Tổng thời gian:</strong> <?php echo $related_quiz['total_time']; ?> phút</p>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
