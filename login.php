<?php
require('config.php');
session_start();
$errormsg = "";
if (isset($_POST['email'])) {

  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "SELECT * FROM `users` WHERE email='$email'and password='" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } else {
    $errormsg  = "Wrong";
  }
} else {
}
?>

<?php include "template.php" ?>
<!-- loads HTML template and Bootstrap   -->
<?php template_header("Login"); ?>
<!-- loads custom styling -->
<link href="css/login.css" rel="stylesheet">



<body>
  
  <div class="login-form">
    <form action="" method="POST" autocomplete="off">
      <h3 class="text-center">Expense App</h3>
      <div class="form-group">
        <div class="col text-center"><br>
            <a href="login.php"><img src="icon/money-bag.png" width="57px" /></a>
        </div><br>
        <input type="text" name="email" class="form-control" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">Login</button>
        <span style="padding-left:10px;" class="">New User?<a href="signup.php" class="text-danger"> Sign up Here</a></span>
      </div>
      <div class="clearfix">
        <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
    </div>
    </form>
    
      <p class="text-center">Forgot Password?<a href="reset.php" class="text-danger"> Reset Here</a></p>
    </div>
    

</body>
</html>