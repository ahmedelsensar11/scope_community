

<?php
//get user posts
include('classes/Db.php');      
include('classes/Post.php');
include('classes/React.php');

//get current user from session
$post = new Post();
//$details = $post -> userDetails(17); //showProfiledetails
$user_details = $post -> userDetails(17);

echo "<pre>";
var_dump($user_details);
echo "<pre/>";
?>
