<?php
$pageTitle = "Reset your password.";
//include('error_reporting.php'); 
include('includes/functions.php');


if(getValue('type')!= ""){
    $type = getValue('type');

    if($type == "activateuser"){ 
        session_start();
        $email = getValue('e');
        $secret =   getValue('key'); 
        $str        = "select id from tblusers where secret = '$secret'";
        $strRs      = Run($str);
        $Records    = getRecord($strRs);
        if($Records > 0){
        
            $str = "update tblusers set status = 1 where secret = '$secret'";
            Run($str);
            showMessage('success', 'Thank you for activating your account. Please login below.');  
            echo "<script>window.location.href = 'login.php?msg=success';</script>";
            header('Location: login.php');
        }else{
            showMessage('error', 'There is some error with your account.'); 
            echo "<script>window.location.href = 'login.php?msg=error';</script>";
        }
 
    }
    else if($type="resetpassword")  {
        
        $secret = getValue('key');
        if($secret != ''){
            $current_date = date("Y-m-d H:i:s");
            $str    = "select * from tblusers where secret_expire_at > '$current_date' and secret = '$secret'"; 
            $strRs  = Run($str);
            $strRec = getRecord($strRs);
            $strRow = GetRow($strRs);
            session_start();
            $_SESSION['user_email'] = $strRow['email']; 
            $_SESSION['user_id'] = $strRow['id']; 
            if($strRec == 0){
                $str = "update tblusers set status = 1 where email = '" . $strRow['email'] . "'";
                showMessage('error', "Link Expired"); 
                echo "<script>window.location.href = 'login.php';</script>"; 
                die();
            }else{ 
                
                 showMessage('success', "Reset your password below"); 
                 echo "<script>window.location.href = 'update-password.php';</script>";  
                 die();
                
            } 
        }
    }
}