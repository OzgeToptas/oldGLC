    <?php 
    $random_query = mysqli_query($link, "select * from users order by rand() limit 0,10");
    ?>

<div class="random">

<div class="random_users_wrapper">
<?php 
    while($random_fetch = mysqli_fetch_array($random_query)):
?>
    <?php $random_id = $random_fetch['id']; ?>       
    <div class="random_row" id="<?php echo $random_id ?>">
    <?php
        $random_profile_query = mysqli_query($link, "select * from photos where user_id = '$random_id' and is_profile = 1 ");
        $random_info_query = mysqli_query($link, "select * from infos where user_id = '$random_id'");
        $random_profile_fetch = mysqli_fetch_array($random_profile_query);
        $random_info_fetch = mysqli_fetch_array($random_info_query);
    ?>
        <a href="user.php?user=<?php echo $random_id ?>"><div class="random_profile" style="background-image:url(    <?php echo checkPhoto($random_profile_fetch['path'],$random_info_fetch['gender']) ?>)"></div></a>
        <div class="random_name_and_location">
            <a href="user.php?user=<?php echo $random_id ?>"><div class="random_name"><?php echo $random_fetch['name'] ?></div></a>
            <div class="random_location"><?php echo $random_info_fetch['location'] ?></div>
        </div>
    </div>
    
<?php 
    endwhile;
?>

</div>   
    
</div>