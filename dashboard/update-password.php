<?php 

$pageTitle = "Update Password";
$pageName = "Update Password";
include('includes/functions.php');   
include('top.php'); 
 
?>

<body class="">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">
					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="assets/images/login-images/reset-password-cover.svg" class="img-fluid" width="600" alt=""/>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
						
							<form action="process.php" method="post" name="passwordResetForm" class="passwordResetForm">
								<input type="hidden" name="action" value="update_password"> 
								<div class="card-body p-sm-5">
									<div class="">
										<div class="mb-4 text-center">
											<img src="assets/logo/logo-transparent.png" width="350px" alt="logo">  
										</div>
										<?php  // if(isset($_SESSION['msg'])) {echo $_SESSION['msg'];}; $_SESSION['msg'] = ""; ?>
										<div class="text-start mb-4">
											<h5 class="">Genrate New Password</h5>
											<p class="mb-0">We received your reset password request. Please enter your new password!</p>
										</div>
										<div class="mb-3 mt-4">
											<label class="form-label">New Password</label>
											<input name="password" id="password" type="password" class="form-control" placeholder="Enter new password" required/>
										</div>
										<div class="mb-4">
											<label class="form-label">Confirm Password</label>
											<input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="Confirm password" required/>
										</div>
										<div class="d-grid gap-2">
											<button type="submit" class="btn btn-primary" id="changePasswordBtn">Change Password</button> 
											<a href="profile.php" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
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
	<script src="assets/js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript"></script>
	<script>
		$('.passwordResetForm').validate({
			rules: {
				password: {
					minlength: 5,
				},
				confirm_password: {
					minlength: 5,
					equalTo: "#password"
				}
			}
		}); 
	</script>
</body>

</html>