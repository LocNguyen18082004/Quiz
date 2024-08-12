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
                        <li class="breadcrumb-item active" aria-current="page">Tất cả Quiz</li>
                    </ol>
                </nav>
                <!-- End Breadcrumb -->
                <div class="mb-3 mb-md-4 d-flex justify-content-between">
                    <div class="h3 mb-0">Tất cả Quiz</div>
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

                <!-- Users -->
                <table class="table text-nowrap mb-0">
                    <thead>
                    <tr>
                        <th class="font-weight-semi-bold border-top-0 py-2">Mã Quiz</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Tên Quiz</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Hình ảnh</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Tổng Thời gian</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Danh mục</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Tổng Số Câu Hỏi</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = ($page - 1) * $limit;
                        foreach($quiz as $key => $pro){
                            $i++;
                        ?>
                    <tr>
                        <td class="py-3"><?php echo $pro['code_quiz'] ?></td>
                        <td class="py-3"><?php echo $pro['title_quiz'] ?></td>
                        <td class="py-3">
                            <?php if (!empty($pro['image_quiz'])) { ?>
                                <img src="<?php echo BASE_URL ?>/layout/uploads/quiz/<?php echo $pro['image_quiz'] ?>"  width="60px"  alt="" >
                            <?php } else { ?>
                                <span>Không có ảnh</span>
                            <?php } ?>
                        </td>
                        <td class="py-3"><?php echo $pro['total_time'] ?> (Phút)</td>
                        <td class="py-3"><?php echo $pro['title_category_quiz'] ?></td>
                        <td class="py-3"><?php echo $pro['total_questions'] ?></td>
                        <td class="py-3">
                            <div class="position-relative">
                                <a style="margin-right:15px" class="link-dark d-inline-block" href="<?php echo BASE_URL ?>/quiz_admin/edit_quiz/<?php echo $pro['id_quiz'] ?>">
                                    <i class="gd-pencil icon-text"></i>
                                </a>
                                <a style="margin-right:15px" class="link-dark d-inline-block" href="<?php echo BASE_URL ?>/quiz_admin/delete_quiz/<?php echo $pro['id_quiz'] ?>">
                                    <i class="gd-trash icon-text"></i>
                                </a>
                                <a style="margin-right:15px" class=" link-dark d-inline-block" href="<?php echo BASE_URL ?>/quiz_admin/list_question/<?php echo $pro['id_quiz'] ?>">
                                    <i class="gd-eye icon-text"></i>
                                </a>
                                <a class="link-dark d-inline-block" href="<?php echo BASE_URL ?>/quiz_admin/add_question_form/<?php echo $pro['id_quiz'] ?>">
                                    <i class="gd-plus icon-text"></i> 
                                </a>

                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                
                <div class="card-footer d-block d-md-flex align-items-center d-print-none">
                    <?php
                        $total_pages = ceil($total_products / $limit);
                        $prev_page = max(1, $page - 1);
                        $next_page = min($total_pages, $page + 1);
                    ?>
                    <nav style="font-size: 18px;" class="d-flex ml-md-auto d-print-none" aria-label="Pagination">
                        <ul class="pagination justify-content-end font-weight-semi-bold mb-0">                
                            <li class="page-item">                
                                <a id="datatablePaginationPrev" class="btn_page prev <?php echo ($page == 1) ? 'disabled' : ''; ?> page-link" href="?page=<?php echo $prev_page; ?> " aria-label="Previous">
                                    <i class="gd-angle-left icon-text icon-text-xs d-inline-block"></i>
                                </a>                
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++){ ?>
                            <li class="page-item d-none d-md-block">
                                <a id="datatablePaginationPage0" class="num_page <?php echo ($i == $page) ? 'active' : ''; ?> page-link" href="?page=<?php echo $i; ?>" data-dt-page-to="0"><?php echo $i; ?></a>
                            </li>
                            <?php } ?>
                            <li class="page-item">                
                                <a id="datatablePaginationNext" class="btn_page next <?php echo ($page == $total_pages) ? 'disabled' : ''; ?> page-link" href="?page=<?php echo $next_page; ?>" aria-label="Next">
                                    <i class="gd-angle-right icon-text icon-text-xs d-inline-block"></i>
                                </a>                
                            </li>                
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Users -->
        </div>
    </div>
</div>

<script>
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
</script>