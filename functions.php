<?php  
include('connection.php');
date_default_timezone_set("Europe/London"); 
$post_time= date("h:i:s");
$post_date = date("Y-m-d");
$current_year = date("Y");
$date = date("Y-m-d H:i:s");

function countUsers($userType){
    $str   = "SELECT user_type, COUNT(*) as user_count FROM tblusers where user_type = '$userType' GROUP BY user_type";
    $strRS = Run($str); 
    $Row   =  GetRow($strRS);
    return $Row['user_count']; 
}


function destroy_any_session(){
    $_SESSION['user_id']        = ''; 
    $_SESSION['firstname']      = '';
    $_SESSION['lastname']       = '';
    $_SESSION['user_type']      = '';
    $_SESSION['email']          = ''; 
    $_SESSION['user_email']     = ''; 
    unset($_SESSION);
    session_destroy();
};

function showMessage($msgtype, $msg){
    session_start();
    if($msgtype == 'error'){ ?>
        <?php $_SESSION['msg'] = '<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Error!</h6>
                    <div class="text-white">'. $msg . '</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
         ?>
   <?php }  else {  
    $_SESSION['msg'] = '<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Success!</h6>
                    <div class="text-white">' . $msg .' </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';  
   }
}

function getProcessorsRS(){
       $processorStr = "SELECT  * FROM tblusers where user_type = 'Processor'";    
        return $processorRs    = Run($processorStr); 
}

function lastInsertId() {
    global $con;
    return mysqli_insert_id($con);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function c($string){
    return strip_tags($string);
}
 
function goToLink($pagename, $id){ 
    echo "<a href='$pagename?id=$id'>$id</a>";
}

function getTitle($table, $ID){
    global $con ;
    $str ="select * from $table where id = $ID";
    $strRs =  mysqli_query($con, $str); 
    $Row   =  mysqli_fetch_assoc($strRs); 
    if($Row != ''){
        return $Row['title'];
    }else{
        return 'N/A';
    }
}

function getSuperAdminEmail(){
    $str = "select email,role,id from tblusers where role = 'Admin'";
    $strRs = Run($str);
    return $strRs;
}

function getRows($table){
    $str = "select * from $table order by id desc";
    return $strRs = Run($str);
}
 
function getNewChatRow($limit){
    $str    = "select * from tblchats where seen = '0' order by post_date asc limit $limit";
    $strRs  = Run($str);
    return $strRs;

 } 
 function countChat(){
     $str    = "select * from tblchats where seen = '0'";
     $strRs =  Run($str);
     $record = getRecord($strRs);
     return $record;
 }
 
 function getValue($value){
    if(isset($_REQUEST[$value])){
        return $value = $_REQUEST[$value];
    }else{
       return $value = '';
    }
 }

 function showStatus($table, $ID){
    $str    = "select * from $table where id = $ID";
    $strRs =  Run($str);
    $strRow = getRow($strRs);
    if($strRow['status'] =='0'){
        return "<span class='btn btn-danger'>Inactive</span>";
    }
    else{
        return "<span class='btn btn-success'>Active</span>";
    }
}
 
function updateChatNotification($ID){
    $ID =  $ID;
    $str = "update tblchats set seen = 1 where ticket_id = '$ID'"; 
    Run($str);
}

function deleteRecord($table, $ID){
    $str = "delete from $table where id = $ID";
    Run($str);
}

function deleteChat($del){
    $str = "delete from tblchats where ticket_id = $del";
    Run($str);
}

function getUserRow(){
    $str    = "select * from tblusers order by id desc";
    $strRs =  Run($str);
    return $strRs;
}

function getSingleRow($table, $ID){
    $str    = "select * from $table where id = $ID";
    $strRs =  Run($str);
    $strRow = getRow($strRs);
    return $strRow;
}

function getAllRow($table){
    $str    = "select * from $table order by id desc";
    $strRs =  Run($str); 
    return $strRs;
}

function getDepartmentAdminEmail($department_type){
    $str    = "select * from tblusers where department_id = '$department_type'";
    $strRs  =  Run($str); 
    $strRow = getRow($strRs);
    return $strRow;
}

function isAdmin(){
    if(isset($_SESSION['user_type'])){ 
        $role = $_SESSION['user_type']; 
        if($role == 'Admin' || $role == "Super Admin"){
            return true;
        }
        else{
             return false;
        }
    }
}
function isLoanOfficer(){
    
    if(isset($_SESSION['user_type'])){
        $role = $_SESSION['user_type'];
        if($role == 'Loan Officer'){
            return true;
        }
        else{
             return false;
        }
    }
}

function checkLogin(){
    if($_SESSION['user_id'] == ""){
        echo "<script>window.location.href = 'login.php';</script>";
        die();
    }
}

function isLoggedin(){
    if($_SESSION['user_id'] != ""){
        return true;
    }else{
        return false;
    }
}

function showDropDown($table, $status_id){
    $selected = '';
    $str = "select id,title,status from $table where status = 1";
    $strRs = Run($str);
    while($strRow = getRow($strRs)){
        if($status_id == $strRow["id"]){$selected = 'selected';}
        echo '<option '. $selected .' value='.$strRow["id"].'>'.$strRow["title"].'</option>';
        $selected = '';
    }
}
 


/*
  $x = pathinfo($url);
     print_r($x);
     echo '<br/>';
     echo $x['dirname'];

*/
/*Date Time*/

function setDateFormat($date){
    $date = new DateTime($date) ;
    return $date->format('d-m-Y') .' at ' .  $date->format('H:i:s') ;
}



function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
} 