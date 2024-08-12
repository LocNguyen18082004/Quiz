<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo BASE_URL ?>/layout/template/img/favicon.ico">

<!-- Template -->
<link rel="stylesheet" href="<?php echo BASE_URL ?>/layout/template/graindashboard/css/graindashboard.css">

<main class="main">

      <div class="content">

			<div class="container-fluid pb-5">

				<div class="row justify-content-md-center">
					<div class="card-wrapper col-12 col-md-4 mt-5">
						<div class="brand text-center mb-3">
							<a href="/"><img src="<?php echo BASE_URL ?>/layout/template/img/logo.png"></a>
						</div>
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Login</h4>
								<form  autocomplete="off" action="<?php echo BASE_URL?>/login/authentication_login" method="POST">
									<div class="form-group">
										<label for="email">Username</label>
										<input id="email" type="text" class="form-control" name="username" required="" autofocus="">
									</div>

									<div class="form-group">
										<label for="password">Password
										</label>
										<input id="password" type="password" class="form-control" name="password" required="">
									</div>

									<div class="form-group">
										<div class="form-check position-relative mb-2">
										  <input type="checkbox" class="form-check-input d-none" id="remember" name="remember">
										  <label class="checkbox checkbox-xxs form-check-label ml-1" for="remember"
												 data-icon="&#xe936">Remember Me</label>
										</div>
									</div>

									<div class="form-group no-margin">
										<button type="submit" class="btn btn-primary btn-block">
											Sign In
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



			</div>

      </div>
</main>

<script src="<?php echo BASE_URL ?>layout/template/graindashboard/js/graindashboard.js"></script>
<script src="<?php echo BASE_URL ?>layout/template/graindashboard/js/graindashboard.vendor.js"></script>