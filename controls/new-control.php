<?php 
    session_start();
    require_once('../database/config.php');

    $password = md5($_POST['new_password']);
    $rand = md5(rand(0,100000));
    $code = strip_tags($_SESSION['code']);
    echo $code;

    $query = mysqli_query($link,"update users set password = '$password', code = '$rand' WHERE code = '$code' ");
    
    if($query){
        $_SESSION['message'] = 'Your password has been changed successfully.';
        header("Location: ../login.php");
    }
    else{
        $_SESSION['message'] = 'An error occurred. Try creating the password again.';
        header("Location: ../login.php");
    }

?>