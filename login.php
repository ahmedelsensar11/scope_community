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
<div class="container formContainer">
    <div class="raw">

    <div class="col-md-6 offset-md-3 py-3 register-div">
    <form action="handleLogin.php" method="POST">


  <div class="form-group">
    <label for="email">Email address</label>
    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

    <div class="form-group">
    <label for="password">Password</label>
    <input name="password" type="password" class="form-control" id="password" />
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
