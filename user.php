<?php include('includes/session.php');//includes ?> 

<?php //check user is already login 
if(!isset($_SESSION['user_id']))
{
    header('location:login.php');
}
?>

<?php
//get all posts
include('classes/Db.php');      
include('classes/User.php');
include('classes/Post.php');

if(isset($_GET['user_id']))
{
$user_id = $_GET['user_id'];

$user = new User();
$post = new Post();
$posts = $post -> showProfilePosts($user_id); //showProfilePosts
$user_details = $user -> userDetails($user_id);
}
?>


<!--head-->
<?php include('includes/head.php');?>


<!--navbar-->
<?php include('includes/navbar.php'); ?>

<!--header photo-->


<!--content-->

<div class="container">
    
    <?php if(isset($_GET['user_id']) && $user_details != false){ ?>
        <!--USER INFO-->
        <div class="row info-container border mb-5">
            <div class="col-md-8 ">
                <div class="row">
                    <div class="col-4  d-flex align-items-center justify-content-center">
                        <?php if($user_details['user_img'] != null ){ ?>
                                <img  src="uploads/<?php echo $user_details['user_img']?>" class="rounded-circle img-fluid img-style" alt="">
                            <?php } else {?>
                                <img  src="images/user.png" class="rounded-circle img-fluid img-style" alt="">
                        <?php }?>                    
                    </div>
                    <div class="col-8  py-0 ">
                        <ul class="info-list ">
                            <li class="list-user my-3"><?php echo $user_details['user_name'] ?></li>
                            <li><button type="button" class="btn btn-follow btn-primary py-2 px-4 my-2">+ FOLLOW</button></li>
                            <!-- Edit profile if id == user_id -->
                            <li class="text-muted  bio my-2 pr-0">user bio user bio user bio user bio user bio user bio user bio</li>
                            <li class="mt-2 d-flex justify-content-center">
                                <div class="">
                                    <a href="#"><i class="icon-info fab fa-twitter"></i></a>
                                    <a href="#"><i class="icon-info fab fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="#"><i class="icon-info fab fa-github" aria-hidden="true"></i></a>
                                    <a href="#"><i class="icon-info fab fa-facebook-square" aria-hidden="true"></i></a>
                                    <a href="#"><i class="icon-info fab fa-instagram" aria-hidden="true"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="col-md-4 info-details pl-0 pr-5 d-flex align-items-center">
                <div class="pl-5 py-1 side-line">

                    <div class="mt-3">
                        <h4 class="detail-titles">work</h4>
                        <p class="detail-desc"><?php echo $user_details['user_work'] ?></p>
                    </div>
                    <div class="mt-3">
                        <h4 class="detail-titles">location</h4>
                        <p class="detail-desc"><?php echo $user_details['user_location'] ?></p>
                    </div>
                    <div class="mt-3">
                        <h4 class="detail-titles">joined at</h4>
                        <p class="detail-desc"><?php echo $user_details['joined_at'] ?></p>
                    </div>

                </div>
                
            </div>
        </div>

        <?php if( $posts != false){ ?>
            <!--USER POSTS-->
            <div class="row">
                <div class="col-lg-9 ">
                        <?php foreach($posts as $post){ ?>
                            <div class="card mb-4" >
                                <div class="card-body py-3">
                                    <div class="row">
                                        <!--
                                            <div class="text-center user-img px-0 ">
                                                
                                            </div>  -->
                                        <div class="col-2 user-post text-center p-0">

                                            <a href="#">
                                                <?php  if($post['user_img'] == null){ ?>
                                                    <img class=" rounded-circle " width="50px" height="50px" src="images/user.png" >
                                                <?php  }else { ?>
                                                    <img class=" rounded-circle " width="50px" height="50px" src="uploads/<?php echo $post['user_img'] ?>" >
                                                <?php  } ?>
                                            </a>
                                            
                                            <div class="card-body post-user-name">
                                                <h4 class="card-title indexUserName"><?php echo$post['user_name'] ?></h4>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col-10 pl-0">
                                            <div class="post-body">
                                                <h4 class="card-title"> <?php echo $post['post_title'] ?> </h4>
                                                <p class="card-text  pr-5 text-muted mb-4"><?php echo substr($post['post_desc'],0,100)."..." ?></p>
                                                <p class="card-text post-time my-1 "><?php echo $post['created_at'] ?> . <?php
                                                    if($post['reading_time'] < 1)
                                                    {
                                                        echo" Less than 1 min"; 
                                                    }else
                                                    {
                                                        echo number_format($post['reading_time'])." min read"; 
                                                    }
                                                    ?>
                                                </p>
                                                <div class=" d-flex justify-content-between">
                                                    <div>
                                                    <a href="postDetails.php?post_id=<?php echo$post['post_id'] ?>" class="card-link">Read More</a>
                                                    <?php if(isset($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']){ ?>
                                                    <a href="editPost.php?post_id=<?php echo$post['post_id'] ?>" class="card-link">Edit</a>
                                                    <a href="handleDeletePost.php?post_id=<?php echo$post['post_id'] ?>" class="card-link" onclick="return confirm('Are you want to delete this post !?');" style="color:red">Delete</a>
                                                    <?php }?>
                                                    </div>
                                                    <a onclick="" class="card-link"><i class="far fa-bookmark  mr-2"></i><span><?php echo number_format($post['save_no']) ?></span></a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                </div>
                            </div>
                        <?php }?>    
                </div>


                <div class="col-lg-3 p-0">
                    <div class="profile-reacts">
                        <ul class=" user-react-list m-0 ">
                            <li>
                                <div class="text-center py-2">
                                    <h5 class="m-0">123</h5>
                                    <p>posts</p>
                                </div>
                            </li>                        
                            <li>
                                <div class="text-center py-2">
                                    <h5 class="m-0">123</h5>
                                    <p>following</p>
                                </div>
                            </li>                        
                            <li>
                                <div class="text-center py-2">
                                    <h5 class="m-0">123</h5>
                                    <p>followers</p>
                                </div>
                            </li>
                            <li>
                                <div class="text-center py-2">
                                    <h5 class="m-0">123</h5>
                                    <p>bookmarks</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php } else {?>
            <div class="no-posts text-center ">
                You Have Not Added Articles Yet.. 
            </div>
        <?php }?>

    <?php } else {?>
        <div class="no-posts text-center ">
            USER NOT FOUND !
        </div>
    <?php }?>    

</div>



<!--footer-->
<?php include('includes/footer.php'); ?>


