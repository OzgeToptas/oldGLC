<?php
require_once('../database/config.php');

$userid = $_GET['i'];
$code = $_GET['a'];


if($userid == null || $code == null){
    $_SESSION['message'] = 'Hatalı bağlantı.';
    header("Location: ../login.php");
}

else{
    $user_query = mysqli_query($link,"select * from users where id = '$userid' and code = '$code' ");
    $is_active_query = mysqli_query($link,"select * from users where id = '$userid' and code = '$code' and is_active = 1 ");
    if(mysqli_num_rows($user_query) < 1){
     $_SESSION['message'] = 'Böyle bir kayıt bulunamadı.';
     header("Location: ../login.php");   
    }
    elseif(mysqli_num_rows($is_active_query) > 0){
     $_SESSION['message'] = 'Bu kullanıcı zaten aktifleştirilmiş.';
     header("Location: ../login.php");     
    }
    else{
        $rand = md5(rand(0,100000));
        $activation = mysqli_query($link,"update users set is_active = 1, code = '$rand' where id = '$userid' ");
        if (!file_exists("../uploads/$userid")) mkdir("../uploads/$userid");
        $info_query = mysqli_query($link,"insert into infos (user_id) values('$userid')");
        $_SESSION['message'] = 'Kayıt işlemi tamamlandı. Giriş yapabilirsiniz.';
        header("Location: ../login.php");
    }
    
}