<div class="container mt-5" id="content">
    <div class="row">
        <div class="col-md-3">
            <h3>Danh mục</h3>
            <ul class="list-group">
                <?php foreach ($category as $key => $cate) { ?>
                    <li class="list-group-item">
                        <a href="<?php echo BASE_URL ?>/index/subject_category/<?php echo $cate['id_category_quiz']; ?>"><?php echo $cate['title_category_quiz']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-9">
            <h2 class="text-center">Danh sách môn học</h2>
            <div class="row">
                <?php foreach ($quizindex as $quiz) { ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-text">Môn học: <?php echo $quiz['title_quiz']; ?></h5>
                                <p class="card-text">Mã Môn học: <?php echo $quiz['code_quiz'] ?></p>
                                <p class="card-text">Tổng thời gian: <?php echo $quiz['total_time']; ?> phút</p>
                                <img src="<?php echo BASE_URL ?>/layout/uploads/quiz/<?php echo $quiz['image_quiz']; ?>"  class="img-fluid mb-3">
                                <a href="<?php echo BASE_URL ?>/quiz/details_subject/<?php echo $quiz['id_quiz'] ?>" class="btn btn-primary">Tìm hiểu thêm</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
