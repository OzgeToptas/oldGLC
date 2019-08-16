<?php 
    require_once('../database/config.php');
    
    $user_id = $_POST['user_id'];
    $firm_name = $_POST['send_firm'];
    $message = $_POST['send_text'];
    $firm_phone = $_POST['send_phone'];
    $message = str_replace("'", '"', $message); 

    $insert_query = mysqli_query($link, "insert into messages (user_id,firm_name,message,firm_phone,is_read) values('$user_id','$firm_name','$message','$firm_phone','is_read')");

    if($insert_query){
        $_SESSION['message'] = 'Mesajınız gönderildi.';
        $_SESSION['message_type'] = 'greenBar';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else{
        $_SESSION['message'] = 'Mesaj gönderilirken bir hata oluştu.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);  
    }

?>