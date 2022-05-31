<?php
require('config.php');

$msg = [];

if (isset($_REQUEST['firstname'])) {

  if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $msg['email'] = [
      'msg' => 'Please use a valid email',
      'class' => 'alert-danger'];
  }

  if (empty($firstname)) {
    $msg['firstname'] = [
      'msg' => 'Cannot be blank',
      'class' => 'alert-danger'];
      }

  if (empty($lastname)) {
    $msg['lastname'] = [
      'msg' => 'Cannot be blank',
      'class' => 'alert-danger'];
      }
  
  if (empty($password)) {
    $msg['password'] = [
      'msg' => 'Please enter a passwowrd',
      'class' => 'alert-danger'];
      }

  if (empty($confirm_password)) {
    $msg['confirm_password'] = [
      'msg' => 'Please enter a passwowrd',
      'class' => 'alert-danger'];
      }

  // if the two passwords match, insert into database
  if ($_REQUEST['password'] == $_REQUEST['confirm_password']) {

    
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($con, $lastname);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

  

    $query = "INSERT into `users` (firstname, lastname, password, email) VALUES ('$firstname','$lastname', '" . md5($password) . "', '$email')";
    $result = mysqli_query($con, $query);
    if ($result) {
      header("Location: index.php");
    }
    else {     echo ("Note: Password and Confirm Password must be identical.");

      // $msg['confirm_password'] = [
      //   'msg' => 'The two passwords are not the same',
      //   'class' => 'alert-danger'];  
    }
  } 
}
?>

<?php include "template.php" ?>
<?php template_header("Sign up");?>
<!-- loads custom styling -->
<link href="css/signup.css" rel="stylesheet">

<body>
  <div class="signup-form">
    <form action="" method="POST" autocomplete="off">
      <h3 class="text-center">Sign Up</h3>
        <div class="col text-center">
              <a href="signup.php"><img src="icon/contract.png" width="57px" /></a>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="firstname">First Name</label> 
              <input type="text" name="firstname" class="form-control" 
                value="<?php echo isset($_POST['firstname']) ? $firstname : ''; ?>">
        
                <!-- output error message and error class for firstname field -->
                <?php if(isset($msg['firstname'])): ?>
                <div class="alert <?php echo $msg['firstname']['class']; ?>"><?php echo $msg['firstname']['msg']?></div>
                <?php endif; ?>
            </div> <!--column-->
            
              <div class="col">
                <label for="lastname">Last Name</label> 
                <input type="text" name="lastname" class="form-control" 
                  value="<?php echo isset($_POST['lastname']) ? $lastname : ''; ?>">

                <!-- output error message and error class for lastname field -->
                <?php if(isset($msg['lastname'])): ?>
                <div class="alert <?php echo $msg['lastname']['class']; ?>"><?php echo $msg['lastname']['msg']?></div>
                <?php endif; ?>
              </div><!--column-->

          </div><!--row -->
        
          <div class="form-group">
            <label for="email">Email</label> 
            <input type="text" name="email" class="form-control" 
            value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            <!-- output error message and error class for email field -->
            <?php if(isset($msg['email'])): ?>
                <div class="alert <?php echo $msg['email']['class']; ?>"><?php echo $msg['email']['msg']?></div>
            <?php endif; ?>
          </div>

        <div class="form-group">
          <label for="password">Password</label> 
          <input type="password" name="password" class="form-control" 
            value="<?php echo isset($_POST['password']) ? $password : ''; ?>">     
            
            <!-- output error message and error class for password field -->
          <?php if(isset($msg['password'])): ?>
          <div class="alert <?php echo $msg['password']['class']; ?>"><?php echo $msg['password']['msg']?></div>
          <?php endif; ?>

        </div>

        <div class="form-group">
        <label for="confirm_password">Confirm Password</label> 
          <input type="password" class="form-control" name="confirm_password" value="<?php echo isset($_POST['confirm_password']) ? $confirm_password : ''; ?>">     
          <!-- output error message and error class for password field -->
          <?php if(isset($msg['confirm_password'])): ?>
          <div class="alert <?php echo $msg['confirm_password']['class']; ?>"><?php echo $msg['confirm_password']['msg']?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
        </div>

        <div class="form-group">
          <a class="btn btn-md btn-light" href="http://localhost:8888/Finance/login.php">Cancel</a>
          <button type="submit" class="btn btn-success btn-md">Register</button>
        </div>

    </form>
    <div class="text-center">Already have an account? <a class="text-success" href="login.php">Login Here</a></div>
  </div>

</body>
</html>