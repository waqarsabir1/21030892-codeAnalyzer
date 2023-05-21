<?php

###LOCAL DB####
 error_reporting(E_ALL);

// define("DB", "codeAnaylyzer");
// define("SR", "localhost");
// define("UN", "root");
// define("PW", "");

define("DB", "waqarsabir_codeAnalyzer");
define("SR", "localhost");
define("UN", "waqarsabir_codeAnalyzer");
define("PW", "codeAnalyzer");

$con = mysqli_connect(SR, UN, PW);
$dB =  mysqli_select_db($con, DB);
 
if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
   }
 
 

#Basic Functions of SQL
function Run($strRs){ 
   global $con ;
   return mysqli_query($con, $strRs);
}

function getRow($strRs){ 
   return mysqli_fetch_assoc($strRs);
}

function getRecord($strRs){
   $records = mysqli_num_rows($strRs);
   return $records;
}