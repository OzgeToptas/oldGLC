<?php
    require_once('database/config.php');
    include('functions/check-info.php');
?>

<div class="header">
       <div class="logo">
           <a href="index.php">
               <div class="logo-text">
               <span class="logo-left"> GET </span>LONDON SERVICES
               </div>
           </a>
           
       </div>
       <div class="list">
           <i class="fa fa-phone" aria-hidden="true"></i>
           <a href="#">Get LONDON Services</a>
           <span class="main-phone">+447395884484</span>
           <ul class="dropdown">
               <li><span class="phone-city">London</span><span class="phone-number">+905468640633</span></li>
               <li><span class="phone-city">London</span><span class="phone-number">+905396525646</span></li>
               <li><span class="phone-city">Turkey</span><span class="phone-number">+447395884484</span></li>
               
           </ul>
       </div>
       <?php if(!isset($_SESSION['login']) ) : ?>
        <div class="sign">
            <div class="sign-links">
                <a href="login.php">
                    <i class="fa fa-user-o" aria-hidden="true"></i>Login
                </a>
                <a href="login.php">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>Sign Up
                </a>
            </div>
        </div>
        <?php 
         
         else:
             $user_id = $_SESSION['login'];
             $user = mysqli_query($link,"select * from users where id = '$user_id' ");
             $profile = mysqli_query($link,"select * from photos where user_id = '$user_id' and is_profile = 1");
             $info = mysqli_query($link,"select * from infos where user_id = '$user_id' ");
             $message = mysqli_query($link,"select * from messages where user_id = '$user_id' and is_read = 0 ");

             $fetch_user = mysqli_fetch_array($user);
             $fetch_profile = mysqli_fetch_array($profile);
             $fetch_info = mysqli_fetch_array($info);

         ?>
       <div class="login-sign">
                <div class="login-sign-wrapper">
                   <div class="header_name">
                        <a href="profile.php"><span><?php echo $fetch_user['name']; ?></span></a>
                    </div>
                    <div class="header_message" title="Mesajlar">
                        <a href="messages.php"><div class="header_message_icon">
                        <?php  if(mysqli_num_rows($message) > 0): ?>
                            <div class="bubble"><?php echo mysqli_num_rows($message) ?></div>
                        <?php else:?>
                        <div class="bubble display_none">0</div>
                         <?php endif;?>
                        </div></a>
                    </div>
                    
                    <a href="profile.php" title="Profil">
                        <div class="header_profile">
                            <div class="header_pic"  style="background-image: url(<?php checkPhoto($fetch_profile['path'],$fetch_info['gender']) ?>)"></div>
                        </div>
                    </a>
                    <div class="header_menu">
                            <ul class="header_nav">
                                <a href="index.php"><li>Home Page</li></a>
                                <a href="profile.php"><li>My Profile</li></a>
                                <a href="messages.php"><li>Messages</li></a>
                                <a href="controls/logout.php"><li>Logout</li></a>
                            </ul>
                            <div class="header_menu_icon"></div>
                        </div>
                </div>
            </div>
            <?php endif; ?>
    </div>