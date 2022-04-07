<?php
include("config.php");
session_start();
if(!isset($_SESSION["email"])){
header("Location: login.php");
exit();
}

// A session is stored on server, a cookie is stored on visitor's browser.  Note the username is first name and last name combined.

$sess_email = $_SESSION["email"];
$sql = "SELECT user_id, firstname, lastname, email, profile_path FROM users WHERE email = '$sess_email'";
$result = $con->query($sql);


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $userid=$row["user_id"];
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $username =$row["firstname"]." ".$row["lastname"];
    $useremail=$row["email"];
    $userprofile="uploads/".$row["profile_path"];
  }
} else {
    $userid="ABC123";
    $username ="Jane Doe";
    $useremail="jane.doe@outlook.com";
    $userprofile="Uploads/default_profile.png";
}
?>