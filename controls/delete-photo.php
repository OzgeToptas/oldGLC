<?php 
    require_once('../database/config.php');
    $id = $_POST['id'];
    $user_id = $_SESSION['login'];
    $photo_query = mysqli_query($link, "select * from photos where id = '$id' ");
    $fetch_photo = mysqli_fetch_array($photo_query);
    $photo_user_id = $fetch_photo['user_id'];
    $path = $fetch_photo['path'];

    if($user_id == $photo_user_id){
        $update_query = mysqli_query($link,"delete from photos where id = '$id' ");
        unlink('../'.$path);
        if($update_query){
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