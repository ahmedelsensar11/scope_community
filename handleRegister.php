<?php

//imports
include('includes/session.php'); //session start
include('classes/Db.php');       //Db class
include('classes/User.php');     //User class   
include('classes/Validator.php');     //Validator class   


//recieve values from register form
if(isset($_POST['submit']))
{
    //var_dump($_POST); for test
    $userName = $_POST['name'];
    $userMail = $_POST['email'];
    $userPassword = $_POST['password'];
    $confirm_Password = $_POST['confirm_password'];
    $userWork = $_POST['work'];
    $userLocation = $_POST['location'];
    $file = $_FILES['userImage']; //super global variable

    //get uploaded file info
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    

    //VALIDATION

    $validator = new Validator();
    $userName     = $validator -> userName($userName);
    $userMail     = $validator -> email($userMail);
    $userPassword = $validator -> password($userPassword, $confirm_Password);
    $userWork     = $validator -> userInfo($userWork, "Work");
    $userLocation = $validator -> userInfo($userLocation, "Location");
    $userImage    = $validator ->image($file_name, $file_error, $file_tmp_name);
    $errors = $validator -> errors; //exsiting errors

    if(!$errors == [] )
    {
        $_SESSION['errors'] = $errors;
        header('location:register.php');
    }
    else
    {
            

        //return image from validation
        if($post_img != false)
        {
            $new_img_name = $post_img ;
        }

        //connection to mySql here 
        //created by imported class (Db) and get connection in ($conn)

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //register ,by register fun from class user
        $user = new User();
        $is_registered = $user ->register($userName, $userPassword, $userMail, $new_img_name, $userWork, $userLocation );

        //after submit register
        if ($is_registered == TRUE) {
            
            //echo "New record created successfully";
                //redirection
            header('location:login.php');

        } 
        else 
        {

            //avoid Duplicate entry
            if ($conn -> errno == 1062){
                //Duplicate Entry
                $_SESSION['errors'] = ['This Email Already Registered, You Have To Login'];
                //redirection
                header('location:register.php');
            }else
            {
                //Query Error
                $_SESSION['errors'] =['Failed To Register'];
                //redirection
                header('location:register.php');
            }
        }

        //close connection
        $conn->close();
    }

}
else
{
    //if is take action for register 
    header('location:index.php');
}



/*
//hints:
($conn = new mysqli) this is class in db contains alot of property for connection between db
('$conn->query', '$conn->error') 'query' and 'error' are 2 properties in main class mysqli
($conn) is already object of class mysqli 

#problems.
1- password shouldn't appear in db, so we need to use incription method to password
2- if name contained of single quat ' ,we will get error so need to use  
*/

?>