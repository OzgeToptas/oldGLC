<?php  
require_once('../database/config.php');
require_once('../securimage/securimage.php');
require_once('../mail/mailer.php');

$securimage = new Securimage();
$captcha = $_POST['register_captcha'];
$name = $_POST['register_name'];
$email = $_POST['register_email'];
$query = mysqli_query($link,"select * from users where email = '$email' ");
$result = mysqli_num_rows($query);



if($securimage->check($captcha) == false){
    $_SESSION['message'] = 'You entered the wrong security code.';
    header("Location: ../login.php");
}
elseif($result > 0){
    $_SESSION['message'] = 'This email address has already been registered.';
    header("Location: ../login.php");
}
else{
    $rand = md5(rand(0,100000));
    $password = md5($_POST['register_password']);
    
    $reqister_query = mysqli_query($link,"insert into users (name,email,code,password) values('$name','$email','$rand','$password')");
    
    $body = file_get_contents('../mail/register-template.html');
    $coming_array = array('username','activationcode','userid');
    $becoming_array = array($name,$rand,mysqli_insert_id($link));
    $body = str_replace($coming_array, $becoming_array, $body);
    
    
    $mail_status = smtpmailer($email,'admin@getlondonservices.co.uk','Get London Services','Membership Activation',$body);
    if($mail_status){
        $_SESSION['message'] = 'Member activation link sent to your email address.';
        header("Location: ../login.php");
    }
    else{
        $_SESSION['message'] = 'An error occurred while sending mail. Try to sign up again.';
        header("Location: ../login.php");
    }
}
    
?>

