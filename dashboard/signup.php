<?php 
session_start();
date_default_timezone_set("Europe/London");
include('includes/functions.php'); 
//include('error_reporting.php'); 
$pageTitle = 'Sign Up ';

   
include('top.php'); ?>
<style>
	.page-footer{
		left:0;
	}
</style>
<body class="">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">
					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex backgroundBg">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="assets/images/login-images/register-cover.svg" class="img-fluid auth-img-cover-login" width="550" alt=""/>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
								<div class="">
									<div class="mb-3 text-center">
										<a href="../"><img src="assets/logo/logo-transparent.png" width="350px" alt="logo"></a>  
                                     </div>
									<div class="text-center mb-4">
										<!-- <h5 class="">Plenty of Processors</h5> -->
										<p class="mb-0">Please fill the below details to create your account</p>
									</div>
									<div class="form-body">
										<?php echo $_SESSION['msg']; $_SESSION['msg'] = ""; ?>
										<form class="row g-3" method="post" action="process.php">
											<input type="hidden" name="action" value="register_user" />
											<div class="col-12">
												<label for="inputFirstName" class="form-label">First Name *</label>
												<input value="<?php echo (getValue('fistname')=="") ? "" : substr(getValue('fistname'),0,500);?>" name="firstname" type="text" class="form-control" id="inputFirstName" placeholder="Jhon" required>
											</div>
											<div class="col-12">
												<label for="inputLastName" class="form-label">Last Name *</label>
												<input value="<?php echo (getValue('lastname')=="") ? "" : substr(getValue('lastname'),0,500);?>" name="lastname" type="text" class="form-control" id="inputLastName" placeholder="Doe" required>
											</div>
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address *</label>
												<input value="<?php echo (getValue('email')=="") ? "" : substr(getValue('email'),0,500);?>" required name="email" type="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com" requried>
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password *</label>
												<div class="input-group" id="show_hide_password">
													<input   minlength="5"  maxlength="20"  size="8"  name="password" type="password" class="form-control border-end-0" id="password" value="" placeholder="Enter Password" required> 
													<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-12">
												<label for="confirm_password" class="form-label">Confirm Password *</label>
												<div class="input-group" id="show_hide_password_2">
													<input   minlength="5"  maxlength="20"  size="8" id="confirm_password" name="inputConfirmPassword" type="password" class="form-control border-end-0"   value="" placeholder="Enter Confirm Password" required> 
													<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-12">
												<label for="confirm_password" class="form-label">Company *</label>
												<div class="input-group" id="company">
													<input  size="8" id="company" name="company" type="text" class="form-control border-end-0"   value="" placeholder="Enter company" required> 
													<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<!-- <div class="col-12">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
													<label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
												</div>
											</div> -->
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary">Sign up</button>
												</div>
											</div>
											<div class="col-12">
												<div class="text-center ">
													<p class="mb-0">Already have an account? 
														<a href="login.php">Sign in here</a></p>
												</div>
											</div>
										</form>
									</div> 
								</div>
							</div>
						</div>
					</div>

				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper--> 
	 
	<!--Password show & hide js -->
	<?php include('footer.php') ?>
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
			$("#show_hide_password_2 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password_2 input').attr("type") == "text") {
					$('#show_hide_password_2 input').attr('type', 'password');
					$('#show_hide_password_2 i').addClass("bx-hide");
					$('#show_hide_password_2 i').removeClass("bx-show");
				} else if ($('#show_hide_password_2 input').attr("type") == "password") {
					$('#show_hide_password_2 input').attr('type', 'text');
					$('#show_hide_password_2 i').removeClass("bx-hide");
					$('#show_hide_password_2 i').addClass("bx-show");
				}
			});
		});


		//validate password//
		var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
	if(password.value != confirm_password.value) {
		confirm_password.setCustomValidity("Passwords Don't Match");
	} else {
		confirm_password.setCustomValidity('');
	}
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>