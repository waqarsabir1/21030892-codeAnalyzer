<?php
include('includes/functions.php');
session_start();
$_SESSION['user_id']        = ''; 
$_SESSION['firstname']      = '';
$_SESSION['lastname']       = '';
$_SESSION['user_type']      = '';
$_SESSION['email']          = ''; 
unset($_SESSION);
session_destroy();
header('Location: login.php');