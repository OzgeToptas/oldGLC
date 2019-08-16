<?php 
    require_once('../database/config.php');
    $id = $_POST['id'];
    $query = mysqli_query($link,"update messages set is_read = 1 where id = '$id' ");
    if($query) echo 'success';
    else echo 'error';
?>