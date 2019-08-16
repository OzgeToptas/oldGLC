<?php 
    require_once('../database/config.php');
    $last_id = $_GET['last_id'];
    $result = mysqli_query($link,"select * from infos where user_id > '$last_id' order by id asc limit 5");
    $response = include __DIR__.'/create-more-data.php';
    $response = ob_get_clean();
    echo $response;
?>
