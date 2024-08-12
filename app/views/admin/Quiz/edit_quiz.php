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
                            <li class="breadcrumb-item active" aria-current="page">Cập nhật Quiz</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Cập nhật Quiz</div>
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

                    <!-- Form -->
                    <div>
                    <?php
                        foreach($quizbyid as $key => $qz) {  
                        ?>
                        <form action="<?php echo BASE_URL ?>/quiz_admin/update_quiz/<?php echo $qz['id_quiz'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Tên Quiz</label>
                                    <input type="text" class="form-control" value="<?php echo $qz['title_quiz'] ?>" id="name" name="title_quiz" required placeholder="">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Mã Quiz</label>
                                    <input type="text" class="form-control" value=""  name="code_quiz" readonly  placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Hình ảnh</label>
                                    <input type="file" class="form-control" value="" id="name" name="image_quiz" required>
                                    <p><img src="<?php echo BASE_URL ?>/layout/uploads/quiz/<?php echo $qz['image_quiz'] ?>" height="100px" width="100px" alt=""></p>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Mô tả</label>
                                    <input type="text" class="form-control" value="<?php echo $qz['desc_quiz'] ?>"  name="desc_quiz" required placeholder="Mô tả...">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Tổng thời gian (phút)</label>
                                    <input type="number" class="form-control" value="<?php echo $qz['total_time'] ?>" id="name" name="total_time" required placeholder="Tên danh mục...">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Danh mục Quiz</label>
                                    <select type="text" class="form-control" value="" id="email" name="category_quiz" required>
                                        <?php 
                                            foreach($category as $key => $cate){
                                        ?>
                                            <option 
                                                <?php if($qz['id_category_quiz']==$cate['id_category_quiz']){
                                                    echo 'selected';
                                                    }
                                                ?>        
                                                value="<?php echo $cate['id_category_quiz']?>"> <?php echo $cate['title_category_quiz'] ?>
                                            </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="randomPassword">
                                <label class="custom-control-label" for="randomPassword">Set Random Password</label>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Cập nhật Danh mục</button>
                        </form>
                    <?php } ?>
                    </div>

                    <!-- End Form -->
                </div>
            </div>


        </div>
    </div>
