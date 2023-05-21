
<?php 
session_start();
$pageTitle = "Forgot Password";
include('top.php'); ?>


<body class="  pace-done" cz-shortcut-listen="true"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">
					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex backgroundBg">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="./assets/images/login-images/forgot-password-cover.svg" class="img-fluid" width="600" alt="">
							</div>
						</div>
					</div>
					 
					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center ">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
							
								<form method="post" action="process.php">
									<div class="mb-3 text-center">
									<a href="../"><img src="assets/logo/logo-transparent.png" width="350px" alt="logo">  </a>
									</div>
									<?php  if(isset($_SESSION['msg'])) {echo $_SESSION['msg'];}; $_SESSION['msg'] = ""; ?>
									<div class="p-3">
										<div class="text-center">
											<img src="./forgotp_files/forgot-2.png" width="100" alt="">
										</div>
										<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
										<p class="text-muted">Enter your registered email ID to reset the password</p>
										<div class="my-4">
											<label class="form-label">Email id</label>
											<input type="email" required name="email" id="email" class="form-control" placeholder="example@user.com">
										</div>
										<div class="d-grid gap-2">
											<input type="hidden" name="action" value="forgot_password">
											<button type="Submit" class="btn btn-primary">Send</button>
											<a href="login.php" class="btn btn-light"><i class="bx bx-arrow-back me-1"></i>Back to Login</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="./forgotp_files/bootstrap.bundle.min.js.download"></script>
	<!--plugins-->
	<script src="./forgotp_files/jquery.min.js.download"></script>
	<script src="./forgotp_files/simplebar.min.js.download"></script>
	<script src="./forgotp_files/metisMenu.min.js.download"></script>
	<script src="./forgotp_files/perfect-scrollbar.js.download"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="./forgotp_files/app.js.download"></script>


</body></html>