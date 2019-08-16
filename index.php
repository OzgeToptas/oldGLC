<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>GET LONDON SERVICES</title>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" type="image/x-icon" href="icons/font-awesome_4-7-0_star_32_8_f15b58_none.png">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato|Nunito|Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="vegas/vegas.css">
    <link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.css">
    
</head>
<body>
<?php 
    include('includes/header.php');
    if(isset($_SESSION['message'])){
        echo "<div class='topBar'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
    }
?>
   <!--    ------3.bölüm burada başlıyor!-------->
   
   <div class="content">
        <div class="message">
            You are looking for service here..
            </div>
        <div class="search">
            <form method="get" action="search.php">
            <div class="search-inputs">
                <div class="search-text">
                    <input type="text" class="input-text" name="search_text" placeholder="Sample: Repairs, Renovations, Painter, Cleaning .." autofocus spellcheck="false" autocomplete="off">
                </div>
                <div class="search-city">
                    <span>Area</span>
                    <ul>
                        <?php 
                            $query_cities = mysqli_query($link,"select * from cities order by is_major desc, name asc");
                            while($fetch_cities = mysqli_fetch_array($query_cities)):
                        ?>
                            <li><label><input type="checkbox" name="city[]" value="<?php echo $fetch_cities['name'] ?>" class="s-check"><?php echo $fetch_cities['name'] ?></label></li>
                        <li>

                        <?php endwhile;?>
                    </ul>
                </div>
                <div class="search-submit">
                    <input type="submit" class="search-button" value="SEARCH">
                </div>
            </div>
          </form>
        </div>
        <div class="all">
            <a href="all.php">ALL SERVICES</a>
        </div>
    </div>
    
    <div class="footer">
       <div>
           <a><i class="fa fa-facebook" aria-hidden="true"></i></a>
           <a><i class="fa fa-instagram" aria-hidden="true"></i></a>
           <a><i class="fa fa-twitter" aria-hidden="true"></i></a>
           <a><i class="fa fa-pinterest" aria-hidden="true"></i></a>
           <a><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
        </div>
    </div>
   <a data-fancybox data-src="#feedback_screen" class="feedback">CONTACT US</a>
    
    <div class="feedback_screen" id="feedback_screen">
    <form id="contact" name="contact" action ="#" method="post">
        <div class="give_feedback"><h3>Report Feedback</h3></div>
        <div class="feedback_message">Your opinions about our site and design are valuable to us.</div>
        <label for="feedback_name" class="feedback_label">Name/Surname</label>
            <input type="text" id="feedback_name" name="feedback_name" class="txt"  autocomplete="off" /><br />
        <label for="feedback_email" class="feedback_label">E-Mail</label>
            <input type="email" name="feedback_email" id="feedback_email" class="txt"  autocomplete="off" />
        <label for="feedback_text" class="feedback_label">Your Opinion</label>
            <textarea name="feedback_text" id="feedback_text" cols="45" rows="8" class="txtarea">Your Opinions..</textarea>
        <input class="feedback_send" id="feedback_send" type="button" value="Send">

        <div id="contact_notifi"></div>
    </form>
</div> 

 


<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="vegas/vegas.min.js"></script>
  <script src="fancybox-master/dist/jquery.fancybox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script> 
  <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script> 
  <script src="js/jquery.maskedinput.min.js"></script>
  <script src="js/jquery.ui.datepicker-tr.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
  <script src="js/main.js"></script>


</body>
</html>

