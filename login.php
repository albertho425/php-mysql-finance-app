<?php
require('config.php');
session_start();
$msg = [];


if (isset($_POST['email'])) {

  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "SELECT * FROM `users` WHERE email='$email'and password='" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);

  if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $msg['email'] = [
      'msg' => 'Please use a valid email',
      'class' => 'alert-danger'];
  }
  
  if (empty($password)) {
    $msg['password'] = [
      'msg' => 'Please enter a passwowrd',
      'class' => 'alert-danger'];
      }
  
  //login is successful
  if ($rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
    //email is valid and password is not empty
  } else if (($email) && ($password)) 
  //login failed
    $msg['login'] = [
      'msg' => 'Login failed. Please try again',
      'class' => 'alert-danger'];
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
        <label for="email">Email</label> 
        <input type="text" name="email" class="form-control"  
          value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
        
        <!-- output error message and error class for email field -->
        <?php if(isset($msg['email'])): ?>
            <div class="alert <?php echo $msg['email']['class']; ?>"><?php echo $msg['email']['msg']?></div>
         <?php endif; ?>
        
      </div> <!--form-group-->
      <div class="form-group">
        <label for="password">Password</label> 
        <input type="password" name="password" class="form-control"
          value="<?php echo isset($_POST['password']) ? $password : ''; ?>">

        <!-- output error message and error class for password field -->
        <?php if(isset($msg['password'])): ?>
            <div class="alert <?php echo $msg['password']['class']; ?>"><?php echo $msg['password']['msg']?></div>
         <?php endif; ?>

      </div> <!--form-group-->

      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">Login</button>
        
        <!-- output error message and error class for login field -->
        <?php if(isset($msg['login'])): ?>
            <div class="alert <?php echo $msg['login']['class']; ?>"><?php echo $msg['login']['msg']?></div>
         <?php endif; ?>

        

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