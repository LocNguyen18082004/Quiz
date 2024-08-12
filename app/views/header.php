<?php session::init(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo BASE_URL ?>/layout/images/favicon.ico" type="image/x-icon">
    <title>Quiz</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/layout/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/layout/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/layout/css/bootstrap.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="row my-2">
                <div class="col">
                    <a href="index.html">
                        <img src="<?php echo BASE_URL ?>/layout/images/logo.png" alt="" class="img-fluid" title="FPT Polytechnic DN" width="150">
                    </a>
                </div>
                <div class="col-12 col-sm-auto my-auto">
                    <a href="mailto:nguyenducloc215@gmail.com" title="Email" class="text-dark">
                        <i class="far fa-envelope"></i>
                        nguyenducloc215@gmail.com
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="navbar">
            <nav class="navbar navbar-expand-lg bg-white">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item home active">
                                <a class="nav-link" href="<?php echo BASE_URL ?>/index/subject" title="Trang chủ"><i class="fas fa-home"></i>
                                    Trang chủ <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo BASE_URL ?>/index/subject">Môn học <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="about.html">Giới thiệu <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hỗ trợ
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="support/contact.html">Liên hệ</a>
                                    <a class="dropdown-item" href="support/FAQ.html">Hỏi đáp</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="support/feedback.html">Góp ý</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav ">
                        <?php 
                        if(isset($_SESSION['user']) && $_SESSION['user'] === true){
                                
                        ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo BASE_URL ?>/user_home/logout">Đăng xuất<span
                                        class="sr-only">(current)</span></a>
                            </li>
                        <?php }else{ ?>

                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo BASE_URL ?>/user_home/login">Đăng nhập<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo BASE_URL ?>/user_home/register">Đăng ký<span class="sr-only">(current)</span></a>
                            </li>

                        <?php } ?>
                           
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>