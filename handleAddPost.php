<?php 

include('includes/session.php'); //session start
include('classes/Db.php');       //Db class
include('classes/Post.php');     //Post class 
include('classes/Validator.php');     //Validator class 

$user_id = $_SESSION['user_id'];
if(isset($_POST['submit']))
{
    //read form data
    $post_title = $_POST['title'];
    $post_desc = $_POST['body'];
    $post_tag = $_POST['tag']; 
    $file = $_FILES['postImg']; //super global variable
    //var_dump($file);// => $_FILES : mithod which can get file datails in array

    //get uploaded file info
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    //You can get more details like: $file_size = $file['size'], $file_type = $file['type'];

  
    
    
    //VALIDATION

    $validator  = new Validator();
    $post_title = $validator -> postTitle($post_title);
    $post_desc  = $validator -> postDesc($post_desc); //confirm_password is null
    $post_img   = $validator-> image($file_name ,$file_error, $file_tmp_name);

    $errors = $validator -> errors; //exsiting errors
    //check form validation
    if(!$errors == [] )
    {
        $_SESSION['errors'] = $errors;
        header('location:addPost.php');
    }
    else
    {
/*      
        this code for upload image , i use this with validation
        if($file_name == "")
        {
            $new_img_name = null;
        }
        else
        {
        //get image's path details
        $file_path_info = pathinfo($file_name);
        $ext = $file_path_info['extension'];

        //prepare image fo upload:
        //make image name is uniq name
        $new_img_name = uniqid().$file_path_info['dirname'].$ext;
        //var_dump($new_img_name);

        //move uploaded image into server destination
        $destination = 'uploads/'.$new_img_name;
        move_uploaded_file($file_tmp_name, $destination);
        }
*/
        //return image from validation
        if($post_img != false)
        {
            $new_img_name = $post_img ;
        }
        
        //object of class post
        $post = new Post();

        //get reading time
        $reading_time =$post ->calcReadingTime($post_desc);
    
        //Add post
        $post -> writePost($user_id, $post_title ,$post_desc, $new_img_name, $post_tag, $reading_time);

        //redirection
        header('location:profile.php');

    }


}
else
{
    //if is take action for add post 
    header('location:index.php');
}

?>