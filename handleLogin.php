<h2>handle log..</h2>
<?php

//session_start
include('includes/session.php');
include('classes/Db.php');
include('classes/User.php');
include('classes/Validator.php');     //Validator class 


if(isset($_POST['submit']))
{
    //var_dump($_POST); for test
    $userMail = $_POST['email'];
    $userPassword = $_POST['password'];

    //VALIDATION

    $validator = new Validator();
    $userMail     = $validator -> email($userMail);
    $userPassword = $validator -> password($userPassword); //confirm_password is null

    $errors = $validator -> errors; //exsiting errors
    //check form validation
    if(!$errors == [] )
    {
        $_SESSION['errors'] = $errors;
        header('location:login.php');
    }
    else
    {

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Login
        $user = new User();
        $loginResult = $user -> login($userMail, $userPassword);
        if ($loginResult->num_rows == 1) {
            // output data of each row
            while($row = $loginResult->fetch_assoc()) {
                //save in session
                $_SESSION['user_id'] = $row["user_id"];
                $_SESSION['user_name'] = $row["user_name"];
                $_SESSION['user_location'] = $row["user_location"];
                $_SESSION['user_work'] = $row["user_work"];
                $_SESSION['user_img'] = $row["user_img"];
                //echo "User_id: ".$_SESSION["user_id"]."<br>"."User_img: ".$_SESSION["user_img"]."<br>"."User_naem: ".$_SESSION["user_name"]."<br/>"."User_bio: ".$_SESSION["user_bio"]."<br>";

                //redirection
                header('location:index.php');
            }
        } else {
            //echo "Not Found";
            $_SESSION['errors'] = ['Failed To Login !'];
            //redirection
            header('location:login.php'); 
        }

        //close connection
        $conn->close();

    }

}
else
{
    //if is take action for login 
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