<?php 
    require_once('../database/config.php');
    $id = $_POST['id'];
    $user_id = $_SESSION['login'];
    $photo_query = mysqli_query($link, "select * from photos where id = '$id' ");
    $photo_user_id = mysqli_fetch_array($photo_query)['user_id'];
    if($user_id == $photo_user_id){
        $update_others = mysqli_query($link,"update photos set is_profile = 0 where user_id = '$user_id' ");
        $update_query = mysqli_query($link,"update photos set is_profile = 1 where id = '$id' ");
        if($update_query && $update_others){
            $_SESSION['message'] = 'Profiliniz başarıyla güncellendi.';
            $_SESSION['message_type'] = 'greenBar';
            header("Location: ../profile.php");

        }
        else{
            $_SESSION['message'] = 'Profil güncelleme sırasında hata oluştu.';
            header("Location: ../profile.php");
        }
    }
    else{
        $_SESSION['message'] = 'Profil güncelleme sırasında hata oluştu.';
        header("Location: ../profile.php");        
    }
?>