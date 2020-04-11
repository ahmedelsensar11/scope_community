<?php

class User
{
    public function login($userMail, $userPassword)
    {
        global $conn;
                
        //make incription on userPassword to compare with incripted value in db
        $userPassword = sha1($userPassword);

        //avoid single quat errors
        $userMail = $conn -> real_escape_string($userMail) ;

        //select query
        $sql = 
        "SELECT user_id, user_name,  user_img, user_location, user_work
        FROM users
        WHERE 
        user_email = '$userMail' AND user_password = '$userPassword'";

        $result = $conn->query($sql);

        return $result;
    }

    public function register($userName, $userPassword, $userMail,  $userImage, $userWork, $userLocation)
    {
        global $conn;

        //incription password
        $userPassword = sha1($userPassword);

        //avoid single quat errors
        $userName = $conn -> real_escape_string($userName) ;
        $userMail = $conn -> real_escape_string($userMail) ;
        $userImage = $conn -> real_escape_string($userImage) ;
        $userWork = $conn -> real_escape_string($userWork) ;
        $userLocation = $conn -> real_escape_string($userLocation) ;
        
        $sql = "INSERT INTO `users`
        ( `user_name`, `user_email`, `user_password`, `joined_at`,  `user_img`, `user_work`, `user_location`) 
        VALUES 
        ('$userName', '$userMail', '$userPassword', CURRENT_DATE(), '$userImage',  '$userWork', '$userLocation')";
        
        $registerResult = $conn->query($sql);
        return $registerResult ; //boolean

    }

    
    //read user details
    public function userDetails($user_id)
    {
        global $conn;
    
        $sql = "SELECT users.*
                FROM users 
                WHERE users.user_id = $user_id";
    
        $result = $conn->query($sql);
        
        
        if ($result->num_rows == 1 ) {
            // output data of each row
            $row = $result->fetch_assoc();
            return $row;
        } 
        else 
        {
            return false;
        }
    

    }


    //update profile
    public function updateProfule($userId, $userName, $userBio, $userImage, $userWork, $userLocation)
    {
        global $conn;

        //avoid single quat errors
        $userName = $conn -> real_escape_string($userName) ;
        $userWork = $conn -> real_escape_string($userWork) ;
        $userLocation = $conn -> real_escape_string($userLocation) ;

        $sql = "UPDATE users SET 
        `user_name` = '$userName',
        `user_work` = '$userWork',
        `user_location` = '$userLocation',
        `user_img` = '$userImage',
        `user_bio` = '$userBio'
        WHERE
        `user_id` = '$userId'
        ";

        if ($conn->query($sql) == TRUE) {

            $_SESSION['user_name'] = $userName;
            $_SESSION['user_location'] = $userLocation;
            $_SESSION['user_work'] = $userWork;
            $_SESSION['user_bio'] = $userBio;
            $_SESSION['user_img'] = $userImage;

            return true;

        }
        else
        {
            return false;
        }


    }



}

?>