<div class="content">
    <div class="py-4 px-3 px-md-4">
        <div class="card mb-3 mb-md-4">
            <div style="font-size: 20px;" class="card-body">
                <!-- Breadcrumb -->
                <nav class="d-none d-md-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Quiz</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách câu hỏi</li>

                    </ol>
                </nav>
                <!-- End Breadcrumb -->
                <div class="mb-3 mb-md-4 d-flex justify-content-between">
                    <div class="h3 mb-0">Danh sách câu hỏi</div>
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
                <!-- Questions -->
                <table class="table text-nowrap mb-0">
                    <thead>
                    <tr>
                        <th class="font-weight-semi-bold border-top-0 py-2">ID</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Câu hỏi</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Thời gian</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Danh mục</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Lựa chọn</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Đáp án đúng</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 0;
                        foreach ($questions as $key => $question) {
                            $i++;
                            $choices = $question['choices']; // Lấy lựa chọn của câu hỏi
                    ?>
                     
                    <tr>
                        <td class="py-3"><?php echo $i ?></td>
                        <td class="py-3"><?php echo $question['question_text']; ?></td>
                        <td class="py-3"><?php echo $question['time_per_question']; ?> (Giây)</td>
                        <td class="py-3"><?php echo $question['id_quiz']; ?></td>
                        <td class="py-3">
                            <ol type="A">
                                <?php foreach ($choices as $choice) { ?>
                                    <li><?php echo $choice['choice_text']; ?> <?php echo $choice['is_correct'] ? '(Đúng)' : ''; ?></li>
                                <?php } ?>
                            </ol>
                        </td>
                        <td class="py-3"><?php echo isset($question['correct_answer']) ? $question['correct_answer'] : 'Chưa có đáp án đúng'; ?></td>
                        <td class="py-3">
                            <div class="position-relative">
                                <a style="margin-right:15px" class="link-dark d-inline-block" href="<?php echo BASE_URL ?>/quiz_admin/edit_question/<?php echo $question['id_question'] ?>">
                                    <i class="gd-pencil icon-text"></i>
                                </a>
                                <a style="margin-right:15px" class="link-dark d-inline-block" href="<?php echo BASE_URL ?>/quiz_admin/delete_question/<?php echo $question['id_question'] ?>">
                                    <i class="gd-trash icon-text"></i>
                                </a>
                               
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                
            </div>
            <!-- End Questions -->
        </div>
    </div>
</div>






<!-- <script>
const urlParams = new URLSearchParams(window.location.search);
const page = urlParams.get('page');
if (page && page > 1) {
    document.addEventListener('DOMContentLoaded', function() {
        const productSection = document.getElementById('content');
        if (productSection) {
            productSection.scrollIntoView();
        }
    });
}
</script> -->