<?php include('includes/session.php');//includes ?> 

<?php
//get all posts
include('classes/Db.php');      
include('classes/Post.php');
include('classes/React.php');

$post = new Post();
$posts = $post -> index();

$react = new React();

//$react ->savePost <?php echo $post['post_id'] , <?php echo $post['user_id'] 
?>

<!--head-->
<?php include('includes/head.php');?>


<!--navbar-->
<?php include('includes/navbar.php'); ?>

<!--header photo-->


<!--content-->

<div class="container">
    <?php if($posts != false){ ?>

        <div class="row">
            <div class="col-lg-8 ">
                    <?php foreach($posts as $post){ ?>
                        <div class="card mb-4" >
                            <div class="card-body py-3">
                                <div class="row">
                                    <!--
                                        <div class="text-center user-img px-0 ">
                                            
                                        </div>  -->
                                    <div class="col-2 user-post text-center p-0">

                                        <a href="user.php?user_id=<?php echo $post['user_id'] ?>">
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

            <div class="col-md-4">
                <?php include('includes/trends.php'); ?>
            </div>
        </div>

    <?php } else {?>
        <div class="no-posts text-center bg-info">
            No articles found yet 
        </div>
    <?php }?>

</div>



<!--footer-->
<?php include('includes/footer.php'); ?>


