  <div class="content">
        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div style="font-size: 20px;" class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Danh mục Quiz</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm Danh mục Quiz</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Thêm Danh mục Quiz</div>
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
                    <form action="<?php echo BASE_URL ?>/quiz_admin/insert_category" method="POST">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Tên danh mục</label>
                                    <input type="text" class="form-control" value="" id="name" name="title_category_quiz" placeholder="User Name">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Mô tả danh mục</label>
                                    <input type="text" class="form-control" value="" id="email" name="desc_category_quiz" placeholder="User Email">
                                </div>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="randomPassword">
                                <label class="custom-control-label" for="randomPassword">Set Random</label>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Thêm danh mục</button>
                        </form>
                    </div>
                    <!-- End Form -->
                    
                </div>
            </div>


        </div>
    </div>
