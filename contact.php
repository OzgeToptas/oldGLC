<?php 
    include("database/config.php");

    $name = $_POST['feedback_name'];
    $email = $_POST['feedback_email'];
    $text = $_POST['feedback_text'];

    $query = mysqli_query($link,"insert into feedback (name,email,text) values('$name','$email','$text')");
    if($query) echo '<span style="color:#2EAE55;">Submission successful</span>';
    else echo '<span style="color:#DD1B1B;">Submission Fail</span>';
?>