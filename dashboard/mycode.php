<?php  
session_start();
date_default_timezone_set("Europe/London"); 
 include('error_reporting.php'); 
//error_reporting(0);
$pageTitle = 'My Code';
$pageName = 'mycode';
include('includes.php');  
 
include('top.php');    
        
$str    =  "select * from tblcode where user_id = ". $_SESSION['user_id'];
$strRss  =  Run($str);


?>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <?php include('sidebar.php') ?>
        <!--end sidebar wrapper -->
        <!--start header -->
        <?php include('header.php') ?>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"></div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">My Code</li>
                            </ol> 
                        </nav>
                    </div>
                    <div class="ms-auto">
						<div class="btn-group">
							<a href="addcode.php" type="button" class="btn btn-primary">Add Code</a> 
						</div>
					</div>
                </div>

                 
                <!--end breadcrumb-->
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Code</th> 
                                                        <th>Explanation</th> 
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($strRow = getRow($strRss)) { ?>
                                                    <tr>
                                                        <td><?php echo $strRow['id'] ?></td>
                                                        <td><?php echo $strRow['title'] ?></td>
                                                        <td><?php echo $strRow['code'] ?></td> 
                                                        <td><?php echo $strRow['explanation'] ?></td> 
                                                        <td><a href="edit">Edit </a><a href="delete">Delete</a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Code</th>
                                                        <th>Explanation</th> 
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
        <?php include('footer.php') ?>

        <script>
        function launch_toast() {
            var x = document.getElementById("toast")
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 5000);
        }
        </script>