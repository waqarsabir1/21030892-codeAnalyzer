<?php 
session_start();



date_default_timezone_set("Europe/London"); 
//include('error_reporting.php'); 
 error_reporting(0);
$pageTitle = 'Favorites';
$pageName  = 'Favorites';
include('includes.php'); 
checkLogin(); 


if(getValue('loan_type')  != "" || getValue('borker') != ""  || getValue('experience') != ""  || getValue('state') != ""  || getValue('work_style') != ""  || getValue('specialties') != ""  ){
    $processorStr = "SELECT tblusers.*, tblprocessor.* FROM tblusers JOIN tblprocessor ON tblusers.id = tblprocessor.user_id where tblusers.user_type = 'Processor' and tblusers.status = 1";  
    if(getValue('loan_type') != ""){
        $processorStr = $processorStr . " and closed_loans = '" . getValue('loan_type') ."'"; 
    }
    if(getValue('borker') != ""){
        $processorStr = $processorStr . " and broker_portals = '" . getValue('borker') . "'"; 
    }
    if(getValue('experience') != ""){
        $processorStr = $processorStr . " and experience = '" . getValue('experience') . "'"; 
    } 
    if(getValue('state') != ""){
        $processorStr = $processorStr . " and state = '" . getValue('state') . "'"; 
    }
    if(getValue('work_style') != ""){
        $processorStr = $processorStr . " and work_style = '" . getValue('work_style') . "'"; 
    }
    if(getValue('specialties') != ""){
        $processorStr = $processorStr . " and specialties = '" . getValue('specialties') . "'"; 
    }
    
    //where tblusers.id = ". $_SESSION['user_id']; 
 }else{
    $processorStr = "SELECT * FROM tblusers LEFT JOIN tblprocessor ON tblusers.id = tblprocessor.user_id where tblusers.user_type = 'Processor' and tblusers.status = 1";

 }

 $processorStr = "SELECT tblfavourites.*, tblusers.* FROM tblfavourites JOIN tblusers ON tblfavourites.processor_id = tblusers.id where tblfavourites.user_id = ". $_SESSION['user_id']; 
 $processorRs    = Run($processorStr);  


//Pagination// 
$limit = 12;  
// query to retrieve all rows from the table Countries 
// get the result 
$processorRs    = Run($processorStr); 
$total_rows     = getRecord($processorRs);    
// get the required number of pages
$total_pages = ceil ($total_rows / $limit);    
// update the active page number
if (!isset ($_GET['page']) ) {  
    $page_number = 1;  
} else {  
    $page_number = $_GET['page'];  
}    
// get the initial page number
$initial_page = ($page_number-1) * $limit;   
// get data of selected rows per page    
$processorStr       = $processorStr . " LIMIT ". $initial_page . ',' . $limit;    
$processorRs        = Run($processorStr);    

//favrouites str//
$favStr = "select * from tblfavourites where user_id = " . $_SESSION['user_id']; 
$favRS  = Run($favStr);
$favRow = mysqli_fetch_all($favRS); 

//print_r($favRow); exit;
 
$processor_id = array_column($favRow, 2);

 

include('top.php');   
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
                                <li class="breadcrumb-item active" aria-current="page">Favorites</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="container">
                    <div class="main-body">
                        
                        <div class="row">
                            <?php while($grid_ROW = getRow($processorRs)){  
                            //echo "<pre>"; print_r($processorROW); echo "</pre>"; ?>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <!-- <img src="assets/images/avatars/avatar-2.png" alt="Admin"
                                                class="rounded-circle p-1 bg-primary" width="110"> --> 
                                                    <?php if($grid_ROW['image']!="") {?>
                                                        <img class="rounded-circle p-1 bg-primary"  src="user_images/<?php echo $grid_ROW['id'] ?>/<?php echo $grid_ROW['image'] ?>" alt="Admin"
                                                        class="rounded-circle p-1 bg-primary" width="110" height="110">  <?php } else{?>
                                                        <img src="assets/images/avatars/default.png" class="rounded-circle p-1 bg-primary"  alt="user avatar" height="110" width="110">
                                                    <?php } ?>  

                                                    <div class="mt-3">
                                                <h4><?php echo $grid_ROW['firstname']." " . $grid_ROW['lastname'] ?></h4>
                                                <p class="text-secondary mb-1">
                                                    <i class="lni lni-map-marker"></i> 
                                                    <?php if($grid_ROW['city'] != ""){ echo $grid_ROW['city']; } else { echo "N/A"; }  ?> 
                                                    <?php echo $grid_ROW['state']; ?> <?php echo $grid_ROW['country'] ?>
                                                </p>

                                                <p class="text-secondary mb-1">
                                                    <i class="lni lni-star-half"></i> Experience:
                                                    <?php echo ($grid_ROW["experience"]=="") ? "N/A" : substr($grid_ROW['experience'],0,500);?>
                                                      
                                                </p>

                                                <p class="text-secondary mb-1">
                                                    <i class="lni lni-checkmark"></i> Loan Closed (3M):
                                                    <?php echo ($grid_ROW["fundings"]=="") ? "N/A" : substr($grid_ROW['fundings'],0,500);?>
                                                      
                                                </p>
                                                <p class="text-secondary mb-1">
                                                    <i class="lni lni-checkmark-circle"></i> Loan Closed (Lifetime):
                                                    <?php echo ($grid_ROW["loans_closed"]=="") ? "N/A" : substr($grid_ROW['loans_closed'],0,500);?>
                                                      
                                                </p>
                                                
                                            </div>
                                            <!-- <div> 
                                                <p class="text-secondary mb-1">
                                                    <div class="d-flex align-items-center theme-icons  cursor-pointer rounded">
							                            <div class="font-22 text-primary"><i class="fadeIn animated bx bx-phone"></i></div>
							                            <div class="ms-2"><a href="tel:<?php echo $userRow['phone'] ?>"><?php echo $userRow['phone'] ?></a></div> 
                                                        <div class="ms-4 font-22 text-primary"><i class="fadeIn animated bx bx-envelope"></i></div>
							                            <div class="ms-2"><a href="mailto:<?php echo $userRow['email'] ?>"><?php echo $userRow['email'] ?></a></div>
                                                    </div>
                                                </p>  
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                                            <a onclick="addFavourite(<?php echo $grid_ROW['id'] ?>, <?php echo $_SESSION['user_id'] ?>)"  
                                            class= "bg-gold <?php echo(in_array($grid_ROW['id'], $processor_id) ? "favourite" : ""); ?> btn btn-dark top-left-radius-0 user<?php echo $grid_ROW['id'] ?>"><i class="bx bxs-heart"></i></a>
                                            
                                            <a href="viewprofile.php?id=<?php echo $grid_ROW['id'] ?>"  class="bg-gold btn btn-dark"><i
                                                    class="bx bx-show-alt"></i></a>
                                            <!-- <a href="chat.php?id=<?php echo $grid_ROW['id'] ?>" class="btn btn-dark top-right-radius-0"><i
                                                    class="bx bx-comment-detail"></i></a>` -->

                                                    <a href="mailto:<?php echo $grid_ROW['email'] ?>" class="bg-gold btn btn-dark top-right-radius-0"><i
                                                    class="bx bx-comment-detail"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <?php } ?>
                        </div>
                        <?php if($total_rows > $limit) { ?>
                            <div class="row">
                                <div class="col-md-12 "> 
                                    <nav aria-label="Page navigation example" class="align-items-center text-center">
                                        <ul class="pagination align-items-center text-center">
                                        <li class="page-item">
                                                <a class="page-link" href="favourite.php?page=1" aria-label="Previous"> <span
                                                        aria-hidden="true">«</span>
                                                </a>
                                        </li>
                                        <?php 
                                        for($page_number = 1; $page_number<= $total_pages; $page_number++) {  ?>
                                            <li class="page-item <?php if(getValue('page') == $page_number ) { ?> active <?php } ?>" >
                                                <a class="page-link" href="favourite.php?page=<?php echo $page_number ?>"><?php echo $page_number; ?></a> 
                                            </li> 
                                        <?php }    ?> 
                                            <li class="page-item">
                                                <a class="page-link" href="favourite.php?page=<?php echo $total_pages ?>" aria-label="Next"> <span
                                                        aria-hidden="true">»</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
        <div id="toast">
            <div id="img">
                <div class="font-22 text-primary">
                    <i class="fadeIn animated bx bx-message-square-check"></i>
                </div>
            </div>
            <div id="desc">Favorites updated</div>
        </div>
        <?php include('footer.php') ?>


        <script>
              
              function addFavourite (processor_id, user_id) { 
                  launch_toast();
                  $('.user'+processor_id).toggleClass('favourite');
                  $.ajax({
                      url:"process.php",    //the page containing php script
                      type: "post",    //request type,
                      dataType: 'json',
                      data: {user_id: user_id, processor_id: processor_id, action: "addFavourite"},
                      success:function(result){ 
                         console.log(result); 
                      }
                  });
              }    

              function launch_toast() {
                var x = document.getElementById("toast")
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
            }
                  
          </script>