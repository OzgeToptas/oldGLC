<?php
    require_once('database/config.php');

    $upload_user_id = $_SESSION['login'];
    $ds = DIRECTORY_SEPARATOR;
    $storeFolder = 'uploads'; 
    if (!empty($_FILES)) {
        
        $tempFile = $_FILES['file']['tmp_name'];     

        $targetPath = 
            dirname( __FILE__ ) . 
            $ds. 
            $storeFolder . 
            $ds. 
            $upload_user_id.
            $ds;  
        
        $fileName = $_FILES['file']['name'];
        
        $targetFile =  $targetPath. $fileName;
            
        move_uploaded_file($tempFile,$targetFile);
        
        $path = $storeFolder.'/'.$upload_user_id.'/'.$fileName;
                
        $upload_query = mysqli_query($link,"insert into photos (user_id,path) values ('$upload_user_id','$path') "); 
    }
?>   