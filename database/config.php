<?php 
    session_start();
    ob_start();

 
 $server = "localhost";
    $username = "ozgeyazi_gls";
    $password = "Gold1905";
    $database = "ozgeyazi_Getlondonservices";

    $link = mysqli_connect($server,$username,$password);
    $db = mysqli_select_db($link,"ozgeyazi_Getlondonservices");




    mysqli_query($link,"set names utf8");
    
?>