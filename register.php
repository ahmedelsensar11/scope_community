<!--session start-->
<?php
include('includes/session.php')
?>

<?php
//check if already login
if(isset($_SESSION['user_id']))
 {
    header('location:index.php');   
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
<form action="handleRegister.php" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" />
    </div>
    
    <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control" id="confirm_password" />
    </div>
    <!--confirm password-->
  


    <div class="d-flex justify-content-between ">
        <div class="form-group w-100 mr-1">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" id="location">
        </div>
        <div class="form-group w-100 ml-1">
            <label for="work">Work</label>
            <input type="text" name="work" class="form-control" id="work">
        </div>
    </div>

    

    <div class="form-group">
        <label for="userImage">Upload Profile Picture</label>
        <input name="userImage" type="file" class="form-control-file" id="userImage">
    </div>


    <div class="text-center mt-3">
    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>

    </div>
    </div>
    </div>

    <!--footer-->

    <?php
    include('includes/footer.php')
    ?>
