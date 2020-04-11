<?php 

include('includes/session.php'); //session start
include('classes/Db.php');       //Db class
include('classes/Post.php');     //Post class 
include('classes/User.php');     //Post class 
include('classes/Validator.php');     //Validator class 


$user_id = $_SESSION['user_id'];
if(isset($_POST['submit']))
{
    //read form data
    $edit_name = $_POST['name'];
    $edit_bio = $_POST['bio'];
    $edit_work = $_POST['work'];
    $edit_location = $_POST['location'];
    $file = $_FILES['userImage']; //super global variable
    //var_dump($file);// => $_FILES : mithod which can get file datails in array
    
    //get uploaded file info
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    //You can get more details like: $file_size = $file['size'], $file_type = $file['type'];

   
    

    //VALIDATION

    $validator  = new Validator();
    $edit_name = $validator -> userName($edit_name) ;
    $edit_bio  = $validator -> textField($edit_bio,"Bio"); //confirm_password is null
    $edit_work = $validator -> textField($edit_work, "Work");
    $edit_location = $validator -> textField($edit_location, "Location");
    $edit_image = $validator ->image($file_name, $file_error, $file_tmp_name);


    $errors = $validator -> errors; //exsiting errors
    //check form validation
    if(!$errors == [] )
    {
        $_SESSION['errors'] = $errors;
        header('location:editProfile.php');
    }
    else
    {
        //get image
        if($edit_image != false)
        {
            $new_edit_img = $edit_image ;
        }

        //Edit post
        $user = new User();
        $is_updated = $user -> updateProfule($user_id, $edit_name,$edit_bio, $new_edit_img, $edit_work, $edit_location);

        if($is_updated == true)
        {
            //redirection
            header('location:profile.php');
        }
        else
        {
            header('location:editprofile.php');

        }
    }   
    
    
}
else
{
    //if did not submit for edit post 
    header('location:index.php');
}

?>