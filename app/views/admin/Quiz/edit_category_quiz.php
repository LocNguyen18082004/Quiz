    <div class="content">
        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div style="font-size: 20px;" class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Danh mục</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cập nhật Danh mục</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Cập nhật Danh mục</div>
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
                        foreach($categorybyid as $key => $cate) {  
                    ?>
                        <form action="<?php echo BASE_URL ?>/quiz_admin/update_category_quiz/<?php echo $cate['id_category_quiz'] ?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Tên danh mục</label>
                                    <input type="text" class="form-control" value="<?php echo $cate['title_category_quiz'] ?>" id="name" name="title_category_quiz" placeholder="Tên danh mục...">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Mô tả danh mục</label>
                                    <input type="text" class="form-control" value="<?php echo $cate['desc_category_quiz'] ?>"  name="desc_category_quiz" placeholder="Mô tả...">
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
