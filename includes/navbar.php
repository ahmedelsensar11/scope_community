

<header class="header">
   <nav class="navbar navbarclr navbar-expand-lg fixed-top navbar-dark py-3">
  <a class="navbar-brand pr-3" href="index.php">SCOPE </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    
    <ul class="navbar-nav ml-auto">
      
      <?php if(!isset($_SESSION['user_name'])) { ?>
        <li class="nav-item ">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      <?php } else { ?>
        <li class="nav-item mr-3">
          <a name="" id="" class="btn btn-primary" href="addPost.php" role="button">Write Post</a>        
        </li>
        <li class="nav-item nav-user-pic">
          <a  class="nav-link" href="profile.php">
            <?php if($_SESSION['user_img'] != null ){ ?>
              <img class=" rounded-circle " width="24px" height="24px" src="uploads/<?php echo $_SESSION['user_img'] ?>" >            
            <?php }else {?> 
              <img class=" rounded-circle " width="24px" height="24px" src="images/user.png" >
            <?php }?>

          </a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['user_name'] ?>
          </a>
          <div class="dropdown-menu m-auto" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
            <a class="dropdown-item" href="#">Bookmarks</a>
            <a class="dropdown-item" href="editProfile.php">Edit Profile</a>
            <a class="dropdown-item" href="#">Theme</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" onclick="return confirm('Do you realy want to logout !?');" href="handleLogout.php">Logout</a>
          </div>
        </li>
        
      <?php } ?>
    </ul>
    </div>
   </nav>
</header>