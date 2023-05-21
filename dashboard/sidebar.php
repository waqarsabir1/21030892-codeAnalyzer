<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				 <div>
					<a href="../">
						<img src="assets/logo/logo-transparent.png" class="logo-icon" alt="logo icon">
					</a>
				</div> 
				 
				<!-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div> -->
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li  <?php if(isset($pageName) && $pageName == "Dashboard"){ ?> class="mm-active" <?php } ?>>
					<a href="index.php" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a> 
				</li> 
				<?php // if(isLoanOfficer()) {?>
				<li  <?php if(isset($pageName) && $pageName == "mycode"){ ?> class="mm-active" <?php } ?>>
					<a href="mycode.php" >
						<div class="parent-icon"><i class='bx bx-user-circle'></i>
						</div>
						<div class="menu-title">My Code</div>
					</a> 
				</li> 
			</ul>
			<!--end navigation-->
		</div>