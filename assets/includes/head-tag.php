<?php 
include('dashboard/includes/functions.php');

if(isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == "SubmitGetStartedForm"){
        extract($_POST, EXTR_OVERWRITE);

        date_default_timezone_set("Europe/London");
        include('includes/functions.php'); 
        //include('error_reporting.php');

        $date = date("Y-m-d H:i:s"); 
        ///EMAIL HEADERS SETTINGS///
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        $headers .= 'From: <noreply@plentyofprocessors.com>' . "\r\n"; 
        $domainUrl = "https://dev.plentyofprocessors.com/dashboard";

        //send email to admin

        $to       =  "waqarsabir1@gmail.com";
        $to2      =  "york@myersx.com";
        $subject  = "Get Started From submitted at plenty of Processors";

        $description = "First Name: ". $firstName . "<br/>";
        $description .= "Last Name: ". $lastName . "<br/>";;
        $description .= "EmailAddress: ". $email;
        $mail  = mail($to,$subject,$description,$headers);
        $mail2 = mail($to2,$subject,$description,$headers);


        if($mail){ 
            showMessage('success', 'Please fill out the form below to create an account with us!'); 
            echo "<script>window.location.href = 'dashboard/signup.php?fistname=$firstName&lastname=$lastName&email=$email';</script>";
            echo "successfully Sent";
        }else{
            echo "email not sent";
        }

    }
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Plenty of Processors</title>
<link rel=icon href=favicon.ico sizes="20x20" type="image/png">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/flaticon.css">
<link rel="stylesheet" href="assets/css/hover-min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">