<!--imports-->
<?php include('includes/session.php') ?>

<?php //check user is already login
if(!isset($_SESSION['user_id']))
{
    header('location:login.php');
}
?>


<?php
//get all posts
include('classes/Db.php');      
include('classes/Post.php');

//get user id from session
$user_id = $_SESSION['user_id'];

if(isset($_GET['post_id']))
{
$post_id = $_GET['post_id'];
$post = new Post();
$editPost = $post -> showPostDetails($post_id);

//save post id in session
$_SESSION['post_id'] = $post_id;
}

?>

<!--head-->
<?php
include('includes/head.php')
?>


<!--navbar-->

<?php
include('includes/navbar.php')
?>



<!--content-->
<?php if (isset($_GET['post_id']) && $editPost !== FALSE && $editPost['user_id'] == $user_id) { ?> 

    <!-- Validation Alert -->
    <div>

        <?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != []) { ?>

            <!--errors alert-->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="m-auto offset-md-3">
                            <ul class="errors-alert bg-danger">
                                <?php foreach($_SESSION['errors'] as $error){ ?>
                                    <li> <?php echo $error ; ?> </li>
                                <?php } ?>    
                            </ul>
                        </div>   
                    </div>
                </div>
                
            </div>

        <?php } ?>

        <?php
        //clear errors after view
        $_SESSION['errors'] = [] 
        ?>

    </div>


    <div class="container mb-4">
            <div class="raw">

            <div class="col-md-6 offset-md-3 py-3 register-div">
        <form action="handleEditPost.php" method="POST" >

            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $editPost['post_title'] ?>">
            </div>

            <div class="form-group">
                <label for="tag">Select Tag</label>
                <select name="tag" class="form-control" id="tag">
                <option>Science</option>
                <option>Economy</option>
                <option>Sports</option>
                <option>World politics</option>
                <option>Other</option>
                </select>
            </div>  

            <div class="form-group">
                <label for="body">Post Body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="5">
                <?php echo $editPost['post_desc'] ?>
                </textarea>
            </div>


            <div class="text-center mt-3">
            <button name="submit" type="submit" class="btn btn-primary">Publish</button>
            </div>
            </form>

            </div>
            </div>
    </div>
<?php }else{?> 

    <div class="no-posts text-center bg-info">
        ERROR : POST NOT FOUND! 
    </div>  

<?php } ?>    


<!--footer-->
<?php
include('includes/footer.php')
?>
