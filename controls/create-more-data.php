<?php
    require_once('../database/config.php');
    include('../functions/check-info.php');

    while($info = mysqli_fetch_array($result)):
    $user_id = $info['user_id'];
    $profile_query = mysqli_query($link,"select * from photos where user_id = '$user_id' and is_profile = 1 ");
    $profile_fetch = mysqli_fetch_array($profile_query);
    $user_query = mysqli_query($link,"select * from users where id = '$user_id' ");
    $user_fetch = mysqli_fetch_array($user_query);
?>
      
    <div class="user_row" id="<?php echo $user_id ?>">
        <a href="user.php?user=<?php echo $user_id ?>">
        <div class="all_profile" 
           style="background-image:url(<?php echo checkPhoto($profile_fetch['path'],$info['gender']) ?>)">
        </div>
        </a>
        <div class="all_name_and_location">
            <a href="user.php?user=<?php echo $user_id ?>"><div class="all_name"><?php echo $user_fetch['name'] ?></div></a>
            <div class="all_location"><?php echo $info['location'] ?></div>
        </div>
        <a href="user.php?user=<?php echo $user_id ?>"><div class="all_look">Profili Gör</div></a>
    </div>
    
<?php 
    endwhile;
?>
