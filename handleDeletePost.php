<?php 

include('includes/session.php'); //session start
include('classes/Db.php');       //Db class
include('classes/Post.php');     //Post class 


//check user is already login
if(!isset($_SESSION['user_id']))
{
    header('location:login.php');
}

elseif(isset($_GET['post_id']))
{
    $user_id = $_SESSION['user_id'] ;
    $post_id = $_GET['post_id'];
    /*
    
    if he owens this post
    
    */
    $post = new Post();
    $is_deleted = $post -> delete($post_id, $user_id);

    if($is_deleted == false)
    {
        /*
        
        Error message 
        
        */
    }

    //what ever is_deleted is , return to index
    header('location:index.php');
}



?>