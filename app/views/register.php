<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Đăng Ký</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo BASE_URL ?>/user_home/insert_dangky" method="POST">
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
                        <div class="text-center mt-3">
                            <a href="<?php echo BASE_URL ?>/login">Đã có tài khoản? Đăng nhập ngay!</a>
                        </div>
                    </form>
                    <?php 
                    
                    if (!empty($_GET['msg'])) {
                        $msg = unserialize(urldecode($_GET['msg']));
                        foreach ($msg as $key => $value) {
                            echo '<div style="margin-top:20px;" class="alert alert-success" role="alert">
                                    <span style="margin-top:20px; font-size:18px">'.$value.'</span>
                                  </div>';
                        }
                    }
                ?>
                
                </div>
            </div>
        </div>
    </div>
</div>
