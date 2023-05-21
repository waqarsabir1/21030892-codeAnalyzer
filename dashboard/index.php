<?php  
session_start();
 

$pageTitle = "Dashboard";
$pageName = "Dashboard";
include('includes.php');  
include('top.php'); 

?>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php include('sidebar.php') ; ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php include('header.php'); ?>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
            <div class="page-content">
			<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4"> 
				  Welcome to Code Analyzer
			</div>
		</div>
		<!--end page wrapper -->
 
<?php include('footer.php') ?>