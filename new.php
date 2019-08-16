<?php 
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>New Password | GetLondonServices</title>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" type="image/x-icon" href="icons/font-awesome_4-7-0_star_32_8_f15b58_none.png">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato|Nunito|Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="vegas/vegas.css">
    <link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.css">
    <meta charset="utf-8">
</head>
<body>
<?php 
    include('includes/header.php');    

    require_once('database/config.php');
    $id =  $_GET['i'];
    $code =  $_GET['a'];
    $_SESSION['code'] = $code;
    if($id == null || $code == null){
        $_SESSION['message'] = 'Hatalı bağlantı.';
        header("Location: login.php");
    }
    else{
        $query = mysqli_query($link,"select * from users where id = '$id' and code = '$code' and is_active = 1");
        if(mysqli_num_rows($query) < 1){
          $_SESSION['message'] = 'No such record was found.';
          header("Location: login.php");  
        }
    }
?>
   
    <div class="login_welcome new_welcome">
        <div class="login_welcome_left">
            <ul class="login_list">
                <li><a href="index.php">Home Page</a></li>
                <li class="seperator"><a href="login.php">Member login</a></li>
                <li class="seperator"><span class="boldtext">New Password</span></li>
            </ul>
        </div>
   	</div>
	<div class="login_middle new_middle">
  		 <div class="both_wrapper new_both_wrapper">
    		<div class="register_wrapper new_wrapper">
    			<h3 class="both_title">New Password</h3>
    			<div class="register_message" id="register_message">You can fill out the form below to renew your password.</div>
                <form name="new_form" id="new_form" action="controls/new-control.php" method="post">
                
                <div class="new_input_div">
                    <label class="register_label" for="new_password" style="width:60%">New Password
                        <input type="password" name="new_password" id="new_password" class="register_input new_input" autocomplete="off" spellcheck="false">
                    </label>
               </div>
               
                <div class="new_input_div">
                    <label class="register_label" for="new_password2" style="width:60%">New Password(Again)
                        <input type="password" name="new_password2" id="new_password2" class="register_input new_input" autocomplete="off" spellcheck="false">
                    </label>
                </div>
                    
      		    <div style="height:80px; width:60%">
                    <input type="submit" class="register_button" id="new_button" name="new_button" value="Kaydet" style="width:30%; float:right;">
                </div>
                
                </form>
			</div>
		</div>
	</div>  
	
	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="vegas/vegas.min.js"></script>
  <script src="fancybox-master/dist/jquery.fancybox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>