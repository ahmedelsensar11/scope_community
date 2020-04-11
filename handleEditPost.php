<?php 

include('includes/session.php'); //session start
include('classes/Db.php');       //Db class
include('classes/Post.php');     //Post class 
include('classes/Validator.php');     //Validator class 


$post_id = $_SESSION['post_id'];
if(isset($_POST['submit']))
{
    //read form data
    $post_title = $_POST['title'];
    $post_desc = $_POST['body'];
    $post_tag = $_POST['tag']; 

    /* 
    // if you want to handle edit image, you should edit this code

    $file = $_FILES['postImg']; //super global variable
    
    //var_dump($file);// => $_FILES : mithod which can get file datails in array
    
    //get uploaded file info
    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    //get image's path details
    $file_path_info = pathinfo($file_name);
    $ext = $file_path_info['extension'];


    //make image name is uniq name
    $new_img_name = uniqid().$file_path_info['dirname'].$ext;
    //var_dump($new_img_name);

    //move uploaded image into server destination
    $destination = 'uploads/'.$new_img_name;
    move_uploaded_file($file_tmp_name, $destination);
    
    */    
    

    //VALIDATION

    $validator  = new Validator();
    $post_title = $validator -> postTitle($post_title);
    $post_desc  = $validator -> postDesc($post_desc); //confirm_password is null

    $errors = $validator -> errors; //exsiting errors
    //check form validation
    if(!$errors == [] )
    {
        $_SESSION['errors'] = $errors;
        header('location:editPost.php?post_id='.$post_id);
    }
    else
    {
        //Edit post
        $post = new Post();
        $is_updated = $post -> update($post_id, $post_title, $post_desc, $post_tag);

        if($is_updated == true)
        {
            //redirection
            header('location:postDetails.php?post_id='.$post_id);
        }
        else
        {
            header('location:editPost.php?post_id='.$post_id);

        }
    }   
    
    
}
else
{
    //if did not submit for edit post 
    header('location:index.php');
}

?>