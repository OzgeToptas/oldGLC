<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Profile | GetLondonServices</title>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" type="image/x-icon" href="icons/font-awesome_4-7-0_star_32_8_f15b58_none.png">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato|Nunito|Open+Sans|Roboto|Raleway|Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.css">
    <link rel="stylesheet" href="jquery-ui-1.12.1/jquery-ui.min.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link href="css/dropzone.css" rel="stylesheet">
</head>
<body>
<?php 
    require_once('database/config.php');
    include('includes/header.php');
    if(!isset($_SESSION['login'])){
        header('Location: login.php');
    }
    if(isset($_SESSION['message'])){
        if(isset($_SESSION['message_type'])){
            $color = $_SESSION['message_type'];
            echo "<div class='topBar $color'>".$_SESSION['message']."</div>";
            unset($_SESSION['message_type']);
        }
       else{
           echo "<div class='topBar'>".$_SESSION['message']."</div>";
       }
        
        unset($_SESSION['message']);
    }

?>
	<div class="profile_photo">
		<div class="profile_square">
        	<div class="circle_wrapper">
            	<a class="fancy_update" data-fancybox data-src="#update">
                	<div class="profile_circle" style="background-image:url(<?php checkPhoto($fetch_profile['path'],$fetch_info['gender']) ?>)">
                		<div class="circle_footer"><i class="fa fa-camera" aria-hidden="true"></i>Update</div>
            		</div>
                </a>
            </div>
        </div>
    </div>
    <div class="profile_name">
        <?php echo $fetch_user['name']; ?>    
    </div>
    <div class="profile_city">
    	<i class="fa fa-map-marker" aria-hidden="true"></i><?php checkInfo($fetch_info['location']); ?>
    </div>
    <div class="edit_profile edit_infos edit_active">
    	<a data-fancybox data-src="#edit" class="fancy_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</a>
    </div>
    
    <div class="edit_profile edit_photos">
    	<a data-fancybox data-src="#drop" class="drop_link" ><i class="fa fa-paperclip" aria-hidden="true"></i>Add / Edit Photos</a>
    </div>
    
    <div class="about_me">
       <blockquote>
            <?php checkAbout($fetch_info['about']); ?>
        </blockquote>
    </div>
    
    
    <div class="action_bar">
    	<div class="action_middle">
        	<div class="action_left action_active">About me</div>
            <div class="action_right">My Photos</div>
            <div class="clearboth"></div>
        </div>
    
    <div class="about display_active">
    	<div class="col1">
        	<ul>
            	<li><i class="fa fa-user-o" aria-hidden="true"></i><?php echo $fetch_user['name'];?></li>
                <li><i class="fa <?php checkGenderIcon($fetch_info['gender']); ?>" aria-hidden="true"></i><?php checkGender($fetch_info['gender'])?></li>
                <li><i class="fa fa-birthday-cake" aria-hidden="true"></i><?php checkBirth($fetch_info['birth_date'])?></li>
                <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php checkInfo($fetch_info['location'])?></li>
            </ul>
        </div>
        <div class="col2">
        	<ul>
            	<li><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo $fetch_user['email'];?></li>
                <li><i class="fa fa-phone" aria-hidden="true"></i><?php checkInfo($fetch_info['phone_number'])?></li>
                <li><i class="fa fa-facebook" aria-hidden="true"></i><?php checkFacebook($fetch_info['facebook_link'])?></li>
                <li><i class="fa fa-instagram" aria-hidden="true"></i><?php checkInstagram($fetch_info['instagram_link'])?></li>
            </ul>
        </div>
        <div class="col3">
        	<ul>
                <li><i class="fa fa-arrows-v" aria-hidden="true"></i><?php checkInfo($fetch_info['height'])?></li>
                <li><i class="fa fa-arrows-h" aria-hidden="true"></i><?php checkInfo($fetch_info['weight'])?></li>
                <li><i class="fa fa-graduation-cap" aria-hidden="true"></i><?php checkInfo($fetch_info['education'])?></li>
                <li><i class="fa fa-bullseye" aria-hidden="true"></i><?php checkViews(1)?></li>
        	</ul>
        </div>
    </div>
  
    <div id="update" style="display:none;">
         <h3>Select From My Photos</h3>
        <?php
            $photo_query = mysqli_query($link,"select * from photos where user_id = '$user_id' ");
            $number_photo = mysqli_num_rows($photo_query);
            if($number_photo > 0):
            while($fetch_photo = mysqli_fetch_array($photo_query)):
        ?>
           <div class='photoItem' style="background-image:url(<?php echo $fetch_photo['path']; ?>)">
               
                <form method="post" action="controls/make-profile.php" class="form_make_profile">
                    <input type="hidden" name="id" value="<?php echo $fetch_photo['id'] ?>">
                    <input type="submit" class="make_profile" value="" title="Profil Fotoğrafı Yap">
                </form>
                
                <form method="post" action="controls/delete-photo.php">
                    <input type="hidden" name="id" value="<?php echo $fetch_photo['id'] ?>">
                    <input type="submit" class="delete_photo" value="" title="Fotoğrafı Sil">
                </form>
               
           </div>
        <?php 
            endwhile;
            else: 
                    
         ?>
            <div class='noPhotoFound'>No photos available.</div>
        <?php endif; ?>

    </div>
    
    
    <div class="photos">
        <?php  
            $photo_query = mysqli_query($link,"select * from photos where user_id = '$user_id' ");
            if(mysqli_num_rows($photo_query)>0): 
        ?>
        <div class="slider-wrapper">
            <div class="slider">
                <?php 
                        while($fetch_photo = mysqli_fetch_array($photo_query)):
                ?>
            <a data-fancybox="photos_gallery" data-src="<?php echo $fetch_photo['path'] ?>" class="fancy_photo">
              <div class="slide">
                  <div class="slider_item" style="background:url(<?php echo $fetch_photo['path'] ?>)">
                      <div class="black_screen"></div>
                  </div>
              </div>
            </a>
        <?php
                endwhile;
            else: 
        ?>
        
        <div class='noPhotoFound noPhotoCarousel'>No photos available.</div>
        
        <?php 
            endif;
        ?>
            </div> 
        </div> 

    </div>

     </div>


    <div id="edit" class="edit">
    	<h3>General Information</h3>
    	<form id="update_info" name="update_info" method="post" action="controls/update-info.php">
    	<input type="text" id="name" class="edit_input" disabled="disabled" placeholder="<?php echo $fetch_user['name'];?>" title="Name surname cannot be changed">
        <select name= "gender" id="gender" class="edit_input">
        	<option <?php if(empty($fetch_info['gender'])) echo 'selected' ?> value="" disabled>Choose</option>
        	<option <?php if($fetch_info['gender'] == 'e') echo 'selected' ?> value="m">Male</option>
            <option <?php if($fetch_info['gender'] == 'k') echo 'selected' ?> value="f">Female</option>
        </select>

        <input type="text" name="birth_date" id="birth_date" class="edit_input" placeholder="Date of birth" 
        value="<?php echo date("d.m.Y",strtotime($fetch_info['birth_date'])) ?>" readonly>
        
        <select id="location" name="location" class="edit_input">
        	<option value="" selected disabled>Choose</option>
            <?php 
                $city_query = mysqli_query($link,"select * from cities order by is_major desc, name asc");
                while($city_fetch = mysqli_fetch_array($city_query)):
            ?>
            <option value="<?php echo $city_fetch['name']; ?>"
               <?php if(!empty($fetch_info['location'] && $fetch_info['location'] == $city_fetch['name'] )) echo "selected"; ?>
            >
                <?php echo $city_fetch['name']; ?>
            </option>
            <?php endwhile; ?>
		</select>
        <h3>İletişim Bilgileri</h3>
        <input type="text" id="email" name="email" disabled="disabled" class="edit_input" placeholder="<?php echo $fetch_user['email']?>" title="E-Mail Address cannot be changed">
        <input type="text" id="phone_number" name="phone_number" class="edit_input" placeholder="Phone number"
        value="<?php echo $fetch_info['phone_number'] ?>">
        <input type="text" id="facebook_link" name="facebook_link" class="edit_input" value="<?php echo $fetch_info['facebook_link'] ?>" placeholder="Facebook Link" spellcheck="false">
        <input type="text" id="instagram_link" name="instagram_link" class="edit_input" value="<?php echo $fetch_info['instagram_link'] ?>" placeholder="İnstagram Link" spellcheck="false"> 
        <h3>Diğer Bilgiler</h3>
        <input type="text" id="height" name="height" class="edit_input" value="<?php echo $fetch_info['height'] ?>" placeholder="Size">
        <input type="text" id="weight" name="weight" class="edit_input" value="<?php echo $fetch_info['weight'] ?>" placeholder="Weight" maxlength="3">
        <input type="text" id="education" name="education" class="edit_input" value="<?php echo $fetch_info['education'] ?>" placeholder="Education" maxlength="50">        
        <input type="text" id="views" name="views" class="edit_input" placeholder="1" disabled="disabled">
        <h3>Hakkımda</h3>
        <textarea id="about_area" name="about_area" class="edit_input about_area" placeholder="Write something." spellcheck="false"><?php echo $fetch_info['about'];?></textarea>
        <div class="select_footer"><input type="submit" class="update_button" id="update_infos" value="Save"></div>
        </form>
    </div>
    
    <div class="drop" id="drop">
        <div class="drop_cover">
            <form action="upload.php" class="dropzone" id="myDropzone">
            <div class="dz-message" data-dz-message><span><span class="cloud_icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></span><span class="drop_text">Drag the files here.</span></span></div>
            </form>
            <div class="select_footer success_message"><a class="update_button update_button_profile" id="file_upload_button">Load<i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
         </div>
        <div class="drop_success">
            <h3>Great!</h3>
            <div class="success_icon"><img src="icons/tick_green.png" width="75px" height="75px"></div>
            <div class="drop_message">All files successfully uploaded.</div>
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
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/jquery.ui.datepicker-tr.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="js/dropzone.js"></script>
    <script type="text/javascript">	
      Dropzone.options.myDropzone = {
        maxFilesize: 2,
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 20,
        dictInvalidFileType: "Invalid file format.",
        dictFileTooBig: "The file is too large. Max: 5 MB",
        dictRemoveFile: "Remove",
        dictCancelUpload: "Cancel",
        init: function() {
            var submitButton = document.querySelector("#file_upload_button")
            myDropzone = this; 
            submitButton.addEventListener("click", function() {
            myDropzone.processQueue(); 
                  myDropzone.on("queuecomplete", function (file) {
                    $('.success_message').css('display','none');
                    $('.dz-remove').css('display','none');
                    function change_fancy(){
                        $('.drop_cover').css('display','none');
                        $('.drop_success').css('display','block');}
                    setTimeout(function(){ change_fancy() },1500);	
                    setTimeout(function(){parent.$.fancybox.close();},3500);		
                    });
            });
        },

      };
    </script>

</body>
</html>