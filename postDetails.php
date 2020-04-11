<?php include('includes/session.php');//includes ?> 

<?php
//get all posts
include('classes/Db.php');      
include('classes/Post.php');

if(isset($_GET['post_id']))
{
$post_id = $_GET['post_id'];
$post = new Post();
$postDetails = $post -> showPostDetails($post_id);

}


?>

<!--head-->
<?php include('includes/head.php');?>


<!--navbar-->
<?php include('includes/navbar.php'); ?>

<!--header photo-->


<!--content-->

<div class="container">
    
        <div class="row">
        
            <div class="col-lg-8">
                <?php if(isset($_GET['post_id']) && $postDetails != false){ ?>
                    
                    <div class="card pb-4" width="100%" >
                        <?php if($postDetails['post_img'] != null) { ?>
                        <div class="postPhoto" style="background-image: url(uploads/<?php echo $postDetails['post_img'] ?>);"></div>
                        <?php } ?>
                        <div class="card-body px-5">
                            <h2 class="card-title postTitle"><?php echo$postDetails['post_title']; ?></h2>
                            <p class="card-text postBody">
                            <?php echo$postDetails['post_desc']; ?>
                            </p>
                            <a href="#" class="btn btn-primary">Like <span><?php echo$postDetails['like_no']; ?></span></a>
                            <button type="button" class="btn btn-danger">Save <span><?php echo$postDetails['save_no']; ?></span></button>
                        </div>
                        <div class="borderLine"></div>
                            <div class="writerInfo py-4 px-5 d-flex justify-content-between align-items-center">
                                <?php if($postDetails['user_img'] != null){ ?>
                                    <img class=" rounded-circle " width="70px" height="70px" src="uploads/<?php echo $postDetails['user_img'] ?>" >
                                <?php }else { ?>
                                    <img class=" rounded-circle " width="70px" height="70px" src="uploads/any-person.jpg" >
                                <?php } ?>  

                                <div class=" py-2">
                                    <h5 class="userName"><?php echo $postDetails['user_name'];?></h5>
                                    <p class="m-0"><?php echo $postDetails['user_work'];?></p>
                                    <p class="m-0"><?php echo $postDetails['user_location'];?></p>
                                </div>
                                <a href="#" class="btn btn-outline-success">FOLLOW</a>
                            </div>
                        <div class="borderLine"></div>
                    </div>

                <?php } else {?>
                    <div class="no-posts text-center bg-info">
                        ERROR : POST NOT FOUND! 
                    </div>
                <?php }?>     
                   
            </div>

            <div class="col-md-4">
                <?php include('includes/trends.php'); ?>
            </div>

        </div>

    

</div>



<!--footer-->
<?php include('includes/footer.php'); ?>


