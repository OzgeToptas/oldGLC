<?php
    require_once('database/config.php');
    for($i=1; $i<13; $i++ ){
        $string = "uploads/1/".$i.".jpeg";
        mysqli_query($link,"insert into photos (user_id, path) values('1','$string')");
    }

?>