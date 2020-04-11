<!--session start-->
<?php
include('includes/session.php')
?>

<?php //check user is already login
if(!isset($_SESSION['user_id']))
{
    header('location:login.php');
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

<!-- Validation Alert -->
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


<!--content-->
<div class="container mb-4">
    <div class="raw">

    <div class="col-md-6 offset-md-3 py-3 register-div">
<form action="handleAddPost.php" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" name="title" class="form-control" id="title"">
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
        <textarea class="form-control" name="body" id="body" cols="30" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label for="postImg">Post Image</label>
        <input name="postImg" type="file" class="form-control-file" id="postImg">
    </div>


    <div class="text-center mt-3">
    <button name="submit" type="submit" class="btn btn-primary">Publish</button>
    </div>
    </form>

    </div>
    </div>
    </div>

    <!--footer-->

    <?php
    include('includes/footer.php')
    ?>
