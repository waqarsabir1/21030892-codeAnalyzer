<?php 
 include('includes/functions.php'); 
 //include('error_reporting.php'); 
session_start();

date_default_timezone_set("Europe/London");

//destroy_any_session();
$pageTitle = 'Login ';

echo $_SESSION['user_id'];

include('top.php'); ?>
  

 <style>
.page-footer {
    left: 0;
}
 </style>

 <body> 
     <!--wrapper-->
     <div class="wrapper">
         <div class="section-authentication-cover">
             <div class="">
                 <div class="row g-0">
                     <div
                         class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                         <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                             <div class="card-body">
                                
                                    <img src="./assets/images/login-images/login-cover-new.svg"
                                     class="img-fluid auth-img-cover-login" width="650" alt="">
                                
                                </div>
                         </div>
                     </div>
                     <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center backgroundBg">
                         <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                             <div class="card-body p-sm-5">
                                 <div class="">
                                     <div class="mb-3 text-center">
                                        <a href="../"><img src="assets/logo/logo-transparent.png" width="350px" alt="logo"></a>
                                     </div>
                                     <?php  if(isset($_SESSION['msg'])) {echo $_SESSION['msg'];}; $_SESSION['msg'] = ""; ?>
                                     <div class="text-center mb-4">
                                         <!-- <h5 class="">Plenty of Processors</h5> -->
                                         <p class="mb-0">Please log in to your account</p>
                                     </div>
                                     <div class="form-body">
                                         <?php  if(isset($_SESSION['msg'])) {echo $_SESSION['msg'];}; $_SESSION['msg'] = ""; ?>
                                         <form method='post' class='row g-3' action="process.php"
                                             enctype="multipart/form-data">
                                             <input type='hidden' name='action' value='login' />
                                             <div class="col-12">
                                                 <label for="inputEmailAddress" class="form-label">Email</label>
                                                 <input name="email" type="text" class="form-control"
                                                     id="inputEmailAddress" placeholder="johndoe@example.com" required>
                                             </div>
                                             <div class="col-12">
                                                 <label for="inputChoosePassword" class="form-label">Password</label>
                                                 <div class="input-group" id="show_hide_password">
                                                     <input name="password" type="password"
                                                         class="form-control border-end-0" id="inputChoosePassword"
                                                         placeholder="Enter Password" required>
                                                     <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                             class="bx bx-hide"></i></a>
                                                 </div>
                                             </div>
                                             <!-- <div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div> -->
                                             <div class="col-md-6 text-end"> <a href="forgotp.php">Forgot Password ?</a>
                                             </div>
                                             <div class="col-12">
                                                 <div class="d-grid">
                                                     <button type="submit" class="btn btn-primary">Sign in</button>
                                                 </div>
                                             </div>
                                             <div class="col-12">
                                                 <div class="text-center ">
                                                     <p class="mb-0">Don't have an account yet? <a
                                                             href="signup.php">Sign up here</a>
                                                     </p>
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
		});
	</script> 
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>
 
</html>