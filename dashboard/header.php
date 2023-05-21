<?php 
	if($_SESSION['user_id'] != "") {
       
	 	$str    				= "select * from tblusers where id = ". $_SESSION['user_id']; 
		$strRs  				= Run($str);
		$userRow 				= getRow($strRs); 
	}else{
		   echo "<script>window.location.href = 'login.php';</script>";
		  die();
	}

	 
	?>
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">
					<form action="processors.php" method="get"> 
					<div class="input-group  ">
						<input type="text" name="query" value="<?php echo getValue('query'); ?>"  class="form-control search-control" placeholder="Search here..." aria-label="Search here..." aria-describedby="button-addon2">
						<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
					</div> 
					<span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>  
				</form>
				</div>
			</div>
			 
			<div class="user-box dropdown">
				<?php if(isLoggedin()) { ?>
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" 
						href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
					<?php if($userRow['image']!="") {?>
					 <img class="user-img"src="user_images/<?php echo $_SESSION['user_id'] ?>/<?php echo $userRow['image'] ?>" alt="Admin" >
					<?php } else{?>
						<img src="assets/images/avatars/default.png" class="user-img" alt="user avatar">
					<?php } ?>	
					<div class="user-info ps-3">
						<p class="user-name mb-0"><?php echo $userRow['firstname']." " .$userRow['lastname'] ?></p>
						<p class="designattion mb-0"><?php echo $userRow['user_type'] ?></p>
					</div>
				</a>
				<?php }else{ ?>
					<a class="d-flex align-items-center" 
						href="login.php"> 
						<img src="assets/images/avatars/default.png" class="user-img" alt="user avatar">
						<div class="user-info ps-3">
							<p class="user-name mb-0">Login</p>
							<p class="designattion mb-0"><?php echo $userRow['user_type'] ?></p>
						</div>
					</a>
				<?php } ?>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<a class="dropdown-item" href="profile.php"><i class="bx bx-user"></i><span>Profile</span></a>
					</li>
					<li>
						<a class="dropdown-item" href="update-password.php"><i class="bx bx-cog"></i><span>Settings</span></a>
					</li> 
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li>
					<li>
						<a class="dropdown-item" href="logout.php"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>