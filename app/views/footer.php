<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#">
                                <img src="<?php echo BASE_URL ?>/layout/images/logo.png" alt="" class="img-fluid" title="FPT Polytechnic DN"
                                    width="150">
                            </a>
                        </li>
                        <li class="list-inline-item"><a href="#">Trang chủ</a></li>
                        <li class="list-inline-item"><a href="#">Giới thiệu</a></li>
                        <li class="list-inline-item"><a href="#">Liên hệ</a></li>
                    </ul>
                    <p>Được thiết kế với nỗi nhớ vô hạn trong mùa <a href="#" rel="noopener"
                            target="_blank" title="COVID-19">COVID-19</a> bởi <a href="#"
                            rel="noopener" target="_blank" title="Đức Lộc">Đức Lộc</a>.</p>
                    <p>Copyright © 2020 BackEnd. All rights reserved.</p>
                </div>
                <div class="col-12 col-sm-auto mt-2">
                    <a href="#" rel="noopener" target="_blank" title="Github"
                        style="margin-right: 15px;text-decoration: none !important;">
                        <i class="fab fa-github fa-lg"></i>
                    </a>
                    <a href="#" rel="noopener" target="_blank"
                        title="Youtube">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
<script>
    window.onscroll = function () {
        myFunction()
    };

    var navbar = document.getElementById("navbar");
    var content = document.getElementById("content");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky");
            content.classList.add("sticky2");
        } else {
            navbar.classList.remove("sticky");
            content.classList.remove("sticky2");
        }
    }
</script>

<script src="<?php echo BASE_URL ?>/layout/js/jquery-3.4.1.slim.min.js"></script>
<script src="<?php echo BASE_URL ?>/layout/js/popper.min.js"></script>
<script src="<?php echo BASE_URL ?>/layout/js/bootstrap.min.js"></script>

</html>