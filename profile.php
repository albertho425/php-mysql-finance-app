<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

if (isset($_POST['save'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];

    $sql = "UPDATE users SET firstname = '$fname', lastname='$lname' WHERE user_id='$userid'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: profile.php');
}

if (isset($_POST['but_upload'])) {

    $name = $_FILES['file']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {

        // Insert record
        $query = "UPDATE users SET profile_path = '$name' WHERE user_id='$userid'";
        mysqli_query($con, $query);

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);

        header("Refresh: 0");
    }
}

?>

<?php include "template.php" ?>
<?php template_header("Profile");?>


<body>
    <?php display_header();?>

    <div class="d-flex" id="wrapper">

        <?php display_sidebar();?>

        <!-- Page Content -->
        <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light  border-bottom">

            <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                <span data-feather="menu"></span>
            </button>

            </nav>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                    <h3 class="mt-4 text-center">Update Profile</h3>
                    <hr>
                        <form class="form" method="post" action="" enctype='multipart/form-data'>
                            <div class="text-center mt-3">
                                <img src="<?php echo $userprofile; ?>" class="text-center img img-fluid rounded-circle avatar" width="120" alt="Profile Picture">
                            </div>
                            <div class="input-group col-md mb-3 mt-3">
                                <div class="custom-file">
                                    <input type="file" name='file' class="custom-file-input" id="profilepic" aria-describedby="profilepicinput">
                                    <label class="custom-file-label" for="profilepic">Change Photo</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit" name='but_upload' id="profilepicinput">Upload Picture</button>
                                </div>
                            </div>


                        </form>


                        
                        <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">

                                        <div class="col-md">
                                            <label for="first_name">
                                                First name
                                            </label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">

                                        <div class="col-md">
                                            <label for="last_name">
                                                Last name
                                            </label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $lastname; ?>" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md">
                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $useremail; ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md">
                                <div class="col-md-12 text-right">
                                    <br>
                                    <a class="btn btn-md btn-light" href="http://localhost:8888/Finance/index.php">Cancel</a>
                                    <button class="btn btn-md btn-success" style="border-radius:0%;" name="save" type="submit">Save Changes</button>
                                </div>
                                </div>
                            </div>
                        </form>
                        <!--/tab-content-->

                    </div>
                    <!--/col-9-->
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace()
    </script>
    <script type="text/javascript">
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });
        });
    </script>
  <?php display_footer();?>

</body>

</html>