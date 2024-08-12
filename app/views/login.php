<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Đăng Nhập</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])) { ?>
                            <div class="alert alert-warning">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                            <?php unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị ?>
                        <?php } ?>
                        <form action="<?php echo BASE_URL ?>/user_home/login_user" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="username" placeholder="Nhập email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng Nhập</button>
                            <div class="text-center mt-3">
                                <a href="<?php echo BASE_URL ?>/signup">Chưa có tài khoản? Đăng ký ngay!</a>
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