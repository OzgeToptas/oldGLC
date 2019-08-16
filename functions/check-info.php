<?php 
    function checkInfo($info){
        if(empty($info)){
            echo " No information. ";
        }
        else{
            echo $info;
        }
    };

    function checkAbout($info){
        if(empty($info)){
            echo "You didn't tell me much about it. You can talk about yourself by clicking the edit profile link. Remember the more information you mean the more job offers.";
        }
        else{
            echo $info;
        }
    };

    function checkAboutUser($info){
        if(empty($info)){
            echo "There is not much information about this user. You can contact him, or <a href='all.php'>from here</a> you can look at other users.";
        }
        else{
            echo $info;
        }
    };

    function checkBirth($info){
        if(empty($info)){
            echo " No information. ";
        }
        else{
            echo date("d.m.Y", strtotime($info));
        }
    };

    
    function checkGender($info){
        if(empty($info)){
            echo " No information. ";
        }
        else{
            if($info == 'e') echo "Man";
            if($info == 'k') echo "Woman";
        }
    };



    function checkPhoto($path,$gender){
        if(empty($path)){
            if(empty($gender)) echo "icons/no-profile.png";
            else{
                if($gender == 'e') echo "icons/male.png";  
                elseif($gender == 'k') echo "icons/female.png";
                else echo "icons/no-profile.png";
            }   
        }
        else{
            echo $path;
        }
    }
    
    function checkGenderIcon($gender){
        if($gender == 'e') echo "fa-mars";
        elseif($gender == 'k') echo "fa-venus";
        else echo "fa-question-circle-o";
    }

    function checkViews($views){
        if($views == 0) echo "No views yet.";
        else echo $views." displayed";
    }
?>