<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Search Results | GetLondonServices</title>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" type="image/x-icon" href="icons/font-awesome_4-7-0_star_32_8_f15b58_none.png">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Lato|Nunito|Open+Sans|Roboto|Raleway|Titillium+Web|Arimo" rel="stylesheet">
    <link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
</head>
<body style="background-color: #e9ebee;">

<?php 
    include('includes/header.php');
    $search_text = $_GET['search_text'];
    $text_array = explode(" ", $search_text);
    !empty($_GET['city']) ? $city_array = $_GET['city'] : $city_array = [];
    
    
    if(empty($search_text) && empty($city_array)){
        header("Location: all.php");
    }
    else{
        $search_query_text = "select * from infos where ";
        
        if(strlen($search_text) > 0){
            $search_query_text .= "(";
            $keys = array_keys($text_array);
            $last_key = end($keys);
            foreach($text_array as $key => $text_element){

                if($key !== $last_key){
                 $search_query_text .= "about like '%" .$text_element."%'";
                 $search_query_text .= " or "; 
                }
                else{
                  $search_query_text .= "about like '%" .$text_element."%'";  
                }
            }    
            $search_query_text .= ")";        
        }

        if(strlen($search_text) > 0 && count($city_array) > 0){
            $search_query_text .= " and ";
        }
        
        if(count($city_array) > 0){
            
            $search_query_text .= "location in (";
            $keys = array_keys($city_array);
            $last_key = end($keys);
            foreach($city_array as $key => $city_element){
                if($key !== $last_key){
                  $search_query_text .= "'" .$city_element."',";  
                }
                else{
                   $search_query_text .= "'" .$city_element."'"; 
                }       
            }
            $search_query_text .= ")";
        }
        
        $search_infos_query = mysqli_query($link, $search_query_text);
    }
    
    
?>

<div class="all_middle">

<div class="user_row_wrapper">
<?php 
    if(mysqli_num_rows($search_infos_query) > 0):
    while($search_infos_fetch = mysqli_fetch_array($search_infos_query)):
?>
        
    <div class="user_row">
        <?php 
        $search_user_id = $search_infos_fetch['user_id'];
        $search_user_name_query = mysqli_query($link,"select * from users where id = '$search_user_id' ");
        $search_user_name_fetch = mysqli_fetch_array($search_user_name_query);
        $search_profile_query = mysqli_query($link, "select * from photos where user_id = '$search_user_id' and is_profile = 1 ");
        $search_profile_fetch = mysqli_fetch_array($search_profile_query);
        ?>
        <a href="user.php?user=<?php echo $search_user_id ?>"><div class="all_profile" style="background-image:url(    <?php echo checkPhoto($search_profile_fetch['path'],$search_infos_fetch['gender']) ?>)"></div></a>
        <div class="all_name_and_location">
            <a href="user.php?user=<?php echo $search_user_id ?>"><div class="all_name"><?php echo $search_user_name_fetch['name'] ?></div></a>
            <div class="all_location"><?php echo $search_infos_fetch['location'] ?></div>
        </div>
        <a href="user.php?user=<?php echo $search_user_id ?>"><div class="all_look">View Profile</div></a>
    </div>
    
<?php 
    endwhile;
?>
    <div class="no_more_results">
    No more results.
    </div>
<?php
    else:
?>
    <div class="no_results_search">
    No search results found.
    </div>
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

   
</body>
</html>