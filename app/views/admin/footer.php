<main class="main" style="width: 100%">
<div class="content">
<footer class="small p-3 px-md-4 mt-auto">
            <div class="row justify-content-between">
                <div class="col-lg text-center text-lg-left mb-3 mb-lg-0">
                    <ul class="list-dot list-inline mb-0">
                        <li class="list-dot-item list-dot-item-not list-inline-item mr-lg-2"><a class="link-dark" href="#">FAQ</a></li>
                        <li class="list-dot-item list-inline-item mr-lg-2"><a class="link-dark" href="#">Support</a></li>
                        <li class="list-dot-item list-inline-item mr-lg-2"><a class="link-dark" href="#">Contact us</a></li>
                    </ul>
                </div>

                <div class="col-lg text-center mb-3 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="gd-twitter-alt"></i></a></li>
                        <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="gd-facebook"></i></a></li>
                        <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="gd-github"></i></a></li>
                    </ul>
                </div>

                <div class="col-lg text-center text-lg-right">
                    &copy; 2019 Graindashboard. All Rights Reserved.
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
</main>

<script src="<?php echo BASE_URL ?>/layout/template/graindashboard/js/graindashboard.js"></script>
<script src="<?php echo BASE_URL ?>/layout/template/graindashboard/js/graindashboard.vendor.js"></script>

<!-- DEMO CHARTS -->
<script src="<?php echo BASE_URL ?>/layout/template/demo/resizeSensor.js"></script>
<script src="<?php echo BASE_URL ?>/layout/template/demo/chartist.js"></script>
<script src="<?php echo BASE_URL ?>/layout/template/demo/chartist-plugin-tooltip.js"></script>
<script src="<?php echo BASE_URL ?>/layout/template/demo/gd.chartist-area.js"></script>
<script src="<?php echo BASE_URL ?>/layout/template/demo/gd.chartist-bar.js"></script>
<script src="<?php echo BASE_URL ?>/layout/template/demo/gd.chartist-donut.js"></script>
<script>
    $.GDCore.components.GDChartistArea.init('.js-area-chart');
    $.GDCore.components.GDChartistBar.init('.js-bar-chart');
    $.GDCore.components.GDChartistDonut.init('.js-donut-chart');
</script>
</body>
</html>