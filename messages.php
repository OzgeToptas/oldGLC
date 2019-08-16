<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Messages | GET LONDON SERVICES</title>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" type="image/x-icon" href="icons/font-awesome_4-7-0_star_32_8_f15b58_none.png">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato|Nunito|Open+Sans|Roboto|Raleway|Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
</head>
<body style="background-color: #e9ebee;">

<?php 
    include('includes/header.php');
    $user_id = $_SESSION['login'];
    if(!isset($user_id)) header("Location: login.php");
    $messages_query = mysqli_query($link, "select * from messages where user_id = '$user_id' order by is_read asc, date desc");
?>

<div class="all_middle">

<div class="user_row_wrapper message_row_wrapper">
<?php 
    if(mysqli_num_rows($messages_query) < 1):     
?>
<div class="no_results_search no_results_message">No messages.</div>
    <?php 
        else:
        while($messages_fetch = mysqli_fetch_array($messages_query)): 
    ?>
    <div class="user_row message_row">
        <div class="all_name_and_location messages_left">
            <a href="#"><div class="all_name"><?php echo $messages_fetch['firm_name'] ?></div></a>
            <div class="all_location"><?php echo date("d.m.Y - h.m.s", strtotime($messages_fetch['date']))?></div>
        </div>
        <div class="message_body"><?php echo str_replace('"', "'",substr($messages_fetch['message'],0,150) )."..."; ?></div>
        <?php if($messages_fetch['is_read'] == 0):?>
            <div class="unread" title="Yeni"></div>
        <?php endif;?>
        <a data-fancybox data-src="#message<?php echo $messages_fetch['id']?>"><div class="all_look message_look" id="<?php echo $messages_fetch['id'] ?>">Mesajı Gör</div></a>
    </div>
    <div id="message<?php echo $messages_fetch['id'] ?>" class="fancy_message display_none">
        <div class="fancy_message_row">
            <div class="fmr-left">Name:</div>
            <div class="fmr-right"><?php echo $messages_fetch['firm_name']; ?></div>
            <div class="clear_both"></div>
        </div>
        <div class="fancy_message_row">
            <div class="fmr-left">Contact:</div>
            <div class="fmr-right"><?php echo $messages_fetch['firm_phone']; ?></div>
            <div class="clear_both"></div>
        </div>
        <div class="fancy_message_row">
            <div class="fmr-left">Messages:</div>
            <div class="fmr-right"><?php echo str_replace('"', "'", $messages_fetch['message']); ?></div>
            <div class="clear_both"></div>
        </div>
        <div class="fancy_message_row">
            <div class="fmr-left">Tarih:</div>
            <div class="fmr-right"><?php echo  date("d.m.Y - h.m.s", strtotime($messages_fetch['date'])) ?></div>
            <div class="clear_both"></div>
        </div>
    </div>
        <?php endwhile;?>
<?php 
    endif;
?>

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
    <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="http://localhost:8000/socket.io/socket.io.js"></script>
    <script>
        var id = <?php echo $_SESSION['login']; ?>;
        var socket = io.connect('http://localhost:8000');
        socket.on('message',function(data){
          var messagesList = [];
          $.each(data.messages,function(index,message){
            if(message.user_id == id && $.inArray(message.id,messagesList) == -1) messagesList.push(message.id);
          });  
          var counter = messagesList.length;
          var title = " GetLondonServices";
          var bubble = $('.bubble');
          if(counter >0){
              bubble.css('visibility','visible');
              if(counter > bubble.html()){
                bubble.slideUp(300,function(){
                    bubble.html(counter);
                    bubble.slideDown(300);
                });
                document.title = "(" + counter + ")" + title;
              }
              if(counter < bubble.html()){}
                bubble.html(counter);
                document.title = "(" + counter + ")" + title;
              }
          else{
            bubble.css('visibility','hidden');
            document.title = title;
          }

        });
  </script>  
   
</body>
</html>