<?php 
    require_once('../database/config.php');

    $user_id = $_SESSION['login'];

    $gender = !empty($_POST['gender']) ? $_POST['gender'] : null;
    $birth_date = !empty($_POST['birth_date']) ? date("Y-m-d", strtotime($_POST['birth_date'])) : null; 
    $location = !empty($_POST['location']) ? $_POST['location'] : null;
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : null;
    //$facebook_link = !empty($_POST['facebook_link']) ? $_POST['facebook_link'] : null;
    //$instagram_link = !empty($_POST['instagram_link']) ? $_POST['instagram_link'] : null;
    //$height = !empty($_POST['height']) ? $_POST['height'] : null;
    //$weight = !empty($_POST['weight']) ? $_POST['weight'] : null;
    //$education = !empty($_POST['education']) ? $_POST['education'] : null;
    $about_area = !empty($_POST['about_area']) ? $_POST['about_area'] : null;
    $about_area = str_replace("'", '"', $about_area);    

    $update_query = mysqli_query($link,"update infos set 
    gender = '$gender',
    birth_date = '$birth_date',
    location = '$location',
    phone_number = '$phone_number',
    facebook_link = '$facebook_link',
    instagram_link = '$instagram_link',
    height = '$height',
    weight = '$weight',
    education = '$education',
    about = '$about_area'
    where user_id = '$user_id' ");

    if($update_query){
        $_SESSION['message'] = 'Profile successfully updated.';
        $_SESSION['message_type'] = 'greenBar';
        header('Location: ../profile.php');
    }
    else{
        $_SESSION['message'] = 'Error updating profile';
        header('Location: ../profile.php');        
    }
?>