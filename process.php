<?php 
date_default_timezone_set("Europe/London");
include('includes/functions.php'); 
//include('error_reporting.php');

$date = date("Y-m-d H:i:s"); 
///EMAIL HEADERS SETTINGS///
//  $headers = "MIME-Version: 1.0" . "\r\n";
//  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
//  $headers .= 'From: <noreply@waqarsabir.com>' . "\r\n"; 
//  $domainUrl = "https://waqarsabir.com/Projects/Staffs/codeAnalyzer/dashboard/";


///EMAIL HEADERS SETTINGS///
if(isset($_POST['action'])){
	$action = $_POST['action'];
	if($action == "register_user"){
		  $firstname 	  = c($_POST['firstname']); 
		  $lastname 	  = c($_POST['lastname']);
		  $email     	  = $_POST['email'];
		  $user_type  	= c($_POST['user_type']);
		  $password  	  = md5($_POST['password']); 
      $str      = "select email from tblusers where email = '$email'";
      $strRs = Run($str);
      if(getRecord($strRs) > 0){
          showMessage('error', 'Email already exists'); 
          echo "<script>window.location.href = 'signup.php';</script>";
      }else{
          $secretkey  =  md5(date('Y m d H:i:S'));
            $str = "insert into tblusers set 
                                          firstname       = '$firstname', 
                                          lastname        = '$lastname',  
                                          email           = '$email',  
                                          password        = '$password',   
                                          company         = '$company',
                                          secret          = '$secretkey',
                                          user_type       = '',
                                          status          =  1, 
                                          post_date       = '$date'";   
        Run($str);
        //$last_id = mysqli_insert_id($conn);
        $last_insert_id = mysqli_insert_id($con); 
           
           session_start(); 
           showMessage('success', 'Thank you for registration. Please login'); 
           echo "<script>window.location.href = 'login.php';</script>";  
         
        }
    }  
  else if($action == 'login'){
    
        $email    =     c($_POST['email']);
        $password =     c($_POST['password']);
        $password =     md5($password);
        // $str = "SELECT users.id, users.fullName, users.email, profiles.about, profiles.photo, profiles.user_type,  profiles.services, profiles.phoneNumber
        //         FROM users
        //         JOIN profiles ON users.id = profiles.user_id where users.email = '$email' and users.password = '" . $password . "' and users.status = 1";  
        $str = "select * from tblusers where   email = '$email' and password = '$password'";    
        $strRs    =  Run($str);
        $strRow   =  getRow($strRs);
        $records  =  getRecord($strRs);  
        if($records > 0){

          $str = "select * from tblusers where   email = '$email' and password = '$password' and status = 1"; 
          $strRs    =  Run($str);
          $strRow   =  getRow($strRs); 
          $records  =  getRecord($strRs);  
          if($records == 0){
            session_start();
            showMessage('error', "Your account is not activated yet.");
            echo "<script>window.location.href = 'login.php';</script>";
          }
          else{
            session_start();
           
            $_SESSION['user_id']      =  $strRow['id'];
            $_SESSION['firstname']    =  $strRow['firstname']; 
            $_SESSION['lastname']     =  $strRow['lastname'];  
            $_SESSION['user_type']    =  $strRow['user_type'];
            $_SESSION['email']        =  $strRow['email'];
            showMessage('success', "loggedin");
            echo "<script>window.location.href = 'index.php';</script>";
            die();
          }
        }
        else{
          session_start();
          showMessage('error', "Email or password is not correct.");
          echo "<script>window.location.href = 'login.php';</script>";
        }
      } 

  else if($action == 'update_basic_profile'){
      session_start(); 
      extract($_POST, EXTR_OVERWRITE);
      if(isset($_POST['company'])){
        $company = $_POST['company']; 
      }else{
        $company = "";
      }
      $str = "update tblusers set 
                          firstname       = '" . c($firstname) . "', 
                          lastname        = '" . c($lastname) . "',  
                          phone           = '" . c($phone) . "',   
                          company         = '" . c($company) . "',   
                          dob             = '" . c($dob) . "',   
                          country         = '" . c($country) . "', 
                          city            = '" . c($city) . "', 
                          state           = '" . c($state) . "', 
                          zip             = '" . c($zip) . "', 
                          address         = '" . c($address) . "' where id = " . $_SESSION['user_id'];   
      Run($str);
      showMessage('success', "Profile updated successfully"); 
      echo "<script>window.location.href = 'profile.php';</script>";
    }
    
  else if($action == 'update_processor_profile'){
    session_start();
      extract($_POST, EXTR_OVERWRITE); 
        $str = "select * from tblprocessor where user_id = ". $_SESSION['user_id'];
        $strRs = Run($str);
        $records =getRecord($strRs);
        $specialties = implode(', ', $specialties);
        $closed_loans = implode(', ', $closed_loans);
        $broker_portals = implode(', ', $broker_portals);
        if($records > 0){ 
          $tags =   c($experience) . "," 
                  . c($licensed) . "," 
                  . c($nmls) . "," 
                  . c($work_style) . "," 
                  . $specialties . "," 
                  . c($broker_portals) . ","  
                  . c($hobbies) . "," 
                  . c($currently_processing_for) . "," 
                  . c($aboutme) . ","   
                  . c($looking_for) ;
            $str = "update tblprocessor set 
                          experience                = '" . c($experience) . "', 
                          licensed                  = '" . c($licensed) . "',  
                          nmls                      = '" . c($nmls) . "',   
                          work_style                = '" . c($work_style) . "',   
                          specialties               = '" .  $specialties . "',  
                          closed_loans              = '" . c($closed_loans) . "', 
                          broker_portals            = '" . c($broker_portals) . "', 
                          looking_for               = '" . c($looking_for) . "', 
                          hobbies                   = '" . c($hobbies) . "', 
                          family                    = '" . c($family) . "', 
                          currently_processing_for  = '" . c($currently_processing_for) . "', 
                          fundings                  = '" . c($fundings) . "', 
                          loans_closed              = '" . c($loans_closed) . "', 
                          aboutme                   = '" . c($aboutme) . "',  
                          tags                      = '" .  $tags  
                          
                          . "' where user_id = " . $_SESSION['user_id'];    
    
        }
        else{
            $str = "insert into tblprocessor set 
                              user_id                   =       '". $_SESSION['user_id'] . "',
                              experience                = '" . c($experience) . "', 
                              licensed                  = '" . c($licensed) . "',  
                              nmls                      = '" . c($nmls) . "',   
                              work_style                = '" . c($work_style) . "',   
                              specialties               = '" .   $specialties . "',  
                              closed_loans              = '" . c($closed_loans) . "', 
                              broker_portals            = '" . c($broker_portals) . "', 
                              looking_for               = '" . c($looking_for) . "', 
                              hobbies                   = '" . c($hobbies) . "', 
                              family                    = '" . c($family) . "', 
                              currently_processing_for  = '" . c($currently_processing_for) . "', 
                              fundings                  = '" . c($fundings) . "', 
                              loans_closed              = '" . c($loans_closed) . "', 
                              aboutme                   = '" . c($aboutme)."'" ; 
        }
 
        Run($str); 
        //echo $str;
        //exit;
        showMessage('success', "Profile updated successfully"); 
        echo "<script>window.location.href = 'profile.php';</script>";
       
      // print_r($_POST);
      // echo "</pre>";
      // exit;
    }

  else if($action == 'update_profile_picture'){
        
        session_start();
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            // Set target directory
            $user_id = $_SESSION['user_id'];
            $target_dir = "user_images/$user_id";
            if(!is_dir($target_dir)){
              mkdir($target_dir);
            }
            $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
            $extension  = pathinfo( $_FILES["photo"]["name"], PATHINFO_EXTENSION ); // jpg
            $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg 
            $source       = $_FILES["photo"]["tmp_name"];
            $destination  = "$target_dir/{$basename}";
            // Set target file path
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            // Get file type
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Allow certain file formats
            $allow_types = array("jpg", "jpeg", "png", "gif");
            // Check if file type is allowed
            if(in_array($file_type, $allow_types)) {
                    // Attempt to move the uploaded file
                    // if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    if(move_uploaded_file( $source, $destination )) { 
                        echo "The file has been uploaded.";
                        $photo = $target_file;

                        //update database//
                        $str = "update tblusers set  image = '$basename ' where id   = ". $_SESSION['user_id'];     
                        Run($str);
                        
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
            } else {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            echo "No file was uploaded.";
        }
    }

  else if($action == 'addcode'){  
    extract($_POST, EXTR_OVERWRITE);
      $user_id      = $_POST['user_id']; 
        $code = str_replace("'","", $code);
        $code = str_replace('"',"", $code);
        $code = str_replace(array('\r','\n'), '', $code);

        $code         = preg_replace('/[^a-zA-Z0-9\s]/', '', $code);
        $explanation  = preg_replace('/[^a-zA-Z0-9\s]/', '', $explanation);

        $str = "insert into tblcode set title = '$title', code = '$code', explanation = '$explanation', user_id =  $user_id"; 
        
       Run($str);
        showMessage('success', "The code has been added to the database library"); 
        echo "<script>window.location.href = 'addcode.php';</script>";  
        return true; 
    } 

  else if($action == 'update_password'){
   
      extract($_POST, EXTR_OVERWRITE); 
        session_start();
      
        $str = "select * from tblusers where email = '". $_SESSION['user_email'] ."' and  id = ". $_SESSION['user_id']; 
        $strRs = Run($str);
        $records =getRecord($strRs);
        if($records > 0){
          $password = md5($password);
            $str = "update tblusers set 
                            password = '$password'
                            where id = " . $_SESSION['user_id'];    
    
        }  
        Run($str);
         
        showMessage('success', "Password updated successfully"); 
        echo "<script>window.location.href = 'login.php';</script>"; 
    }

  else if($action == 'forgot_password'){

          extract($_POST, EXTR_OVERWRITE); 
         
           $str        = "select * from tblusers where email = '". $_POST['email'] . "'" ; 
          $strRs      = Run($str);
          $records    = getRecord($strRs);
          if($records > 0){
            $strRow     = getRow($strRs);
            $userEmail  = $strRow['email'];
            $userName   = ucfirst($strRow['firstname']);
            $userId     = $strRow['id'];
            $secretkey  = md5(rand(100,10000));
            $secretkey  = $secretkey . md5(date('Y m d H:i:S'));
            $hashMd5Id  = md5($userId);
            $hashMd5email = md5($userEmail);
            $new_time = date("Y-m-d H:i:s", strtotime('+1 hours'));
            $inStr = "update tblusers set secret = '$secretkey', secret_expire_at = '$new_time' where id = '$userId'";
            Run($inStr);     
            //send email notification 
            $to =  $userEmail; 
            $subject  = "Reset your password at Plentyofprocessors.com";
            $description = "You’ve asked us to reset your password. No problem – just hit the button and we’ll get you sorted.";
            $button = "<a href='$domainUrl/activate.php?key=$secretkey&e=$hashMd5email&type=resetpassword' target='_blank'
            style='border: solid 1px #3498db; border-radius: 50px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; 
            background-color: #0167d0; border-radius: 50px; border-color: #0167d0; color: #ffffff;'>Reset Passowrd</a> </td>";
            $firstname = "Dear User";
            include('email_templates/email_template.php'); 
            // echo  $inStr . "</br>";
            // echo $secretkey . "</br>"; 
            // echo $button;
            
            // exit;
            //$mail = mail($userEmail,$subject,$messageForUser,$headers);
            if($mail){
              session_start();
              showMessage('success', "Please follow the instructions sent in your email."); 
              echo "<script>window.location.href = 'forgotp.php';</script>";  
            } 
            else{
              showMessage('error', "There was an error in sending the email."); 
              echo "<script>window.location.href = 'forgotp.php';</script>";  
            }
          }
          else{
            session_start();
            showMessage('error', "The email is not currently registered."); 
            echo "<script>window.location.href = 'forgotp.php';</script>"; 
          }
        } 
      } 

?>