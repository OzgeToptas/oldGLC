<?php

    require_once('../database/config.php');
    require_once('../mail/mailer.php');

    $email = $_POST['lost_email'];
    $query = mysqli_query($link,"select * from users where email = '$email' and is_active = 1 ");
    
    if(mysqli_num_rows($query) < 1){
        $_SESSION['message'] = 'No users registered with this email address were found.';
        header("Location: ../login.php");
    }
    else{
        $fetch = mysqli_fetch_array($query);
        $body = file_get_contents('../mail/lost-template.html');
        $coming_array =  array('username','userid','activationcode');
        $becoming_array = array($fetch['name'],$fetch['id'],$fetch['code']);
        $body = str_replace($coming_array,$becoming_array,$body);
        $mail_status = smtpmailer($email,'admin@getlondonservices.co.uk','GetLondonServices.co.uk','Password Reset',$body);
        if($mail_status){
            $_SESSION['message'] = 'The password renewal link has been sent to your email address.';
            header("Location: ../login.php");
        }
        else{
            $_SESSION['message'] = 'An error occurred while sending mail.';
            header("Location: ../login.php");
        }
    }
?>