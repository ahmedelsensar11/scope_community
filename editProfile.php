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
include('classes/User.php');

//get user id from session


if(isset($_SESSION['user_id']))
{

$user_id = $_SESSION['user_id'];
$user = new User();
$editUser = $user -> userDetails($user_id);

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
<?php if ($editUser !== FALSE && $_SESSION['user_id'] == $user_id) { ?> 

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
        <form action="handleEditProfile.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $editUser['user_name'] ?>">
            </div>
  

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" name="bio" id="bio" cols="30" rows="5">
                <?php echo $editUser['user_bio'] ?>
                </textarea>
            </div>
            <div class="d-flex justify-content-between ">
                <div class="form-group w-100 mr-1">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="cairo, egypt" id="location" value="<?php echo $editUser['user_location'] ?>">
                </div>
                <div class="form-group w-100 ml-1">
                    <label for="work">Work</label>
                    <input type="text" name="work" value="<?php echo $editUser['user_work'] ?>" class="form-control" placeholder="software Engineer at google" id="work">
                </div>
            </div>
            
            <div class="form-group">
                <label for="userImage">Change Photo</label>
                <input name="userImage" type="file" value="<?php echo $editUser['user_img'] ?> class="form-control-file" id="userImage">
            </div>


            <div class="text-center mt-3">
                <button name="submit" type="submit" class="btn btn-primary">Edit</button>
            </div>
            </form>

            </div>
        </div>
    </div>
<?php  }else{?> 

    <div class="no-posts text-center bg-info">
        ERROR : PAGE NOT FOUND! 
    </div>  

<?php  } ?>    


<!--footer-->
<?php
include('includes/footer.php')
?>
