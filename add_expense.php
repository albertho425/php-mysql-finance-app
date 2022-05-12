<?php

// for trouble shooting purposes
ini_set('display_errors', 1);
// for trouble shooting purposes
ini_set('display_startup_errors', 1);
// for trouble shooting purposes
error_reporting(E_ALL);


include("session.php");

// define variables and set to empty values
$expenseamount = $expensename = $expensenote = $expensecategory =  "";
$expensedate = date("Y-m-d");

//$update and $del determine the color and message of the submit button
$update = false;
$del = false;

if (isset($_POST['add'])) {
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];
    $expensename = $_POST['expensename'];
    $expensenote = trim($_POST['expensenote']);

    $expenses = "INSERT INTO expenses (user_id, expense,expensedate,expensecategory,expensename,expensenote) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory','$expensename','$expensenote')";
    $result = mysqli_query($con, $expenses) or die("Error in insertion!");

    if ($result) {
        echo "Record successfully added";
    }

    header('location: add_expense.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];
    $expensename = $_POST['expensename'];
    $expensenote = trim($_POST['expensenote']);

    $sql = "UPDATE expenses SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory', expensename='$expensename' expensenote='$expensenote' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR in update: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];
    $expensename = $_POST['expensename'];
    $expensenote = trim($_POST['expensenote']);


    $sql = "DELETE FROM expenses WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR in delete: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
        $expensename = $n['expensename'];
        $expensenote = $n['expensenote'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
        $expensename = $n['expensename'];
        $expensenote = $n['expensenote'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
?>

<?php include "template.php" ?>
<?php template_header("Add Expense");?>


<body>

    <?php display_header();?>
    <div class="d-flex" id="wrapper">

        <?php display_sidebar();?>

        <!-- Page Content -->
        <div id="page-content-wrapper">

        <?php display_secondary_nav(); ?>


            <div>
            
                <h3 class="mt-4 text-center">Add Expenses</h3>
                
                <div class="row">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Cost</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" id="expenseamount" name="expenseamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensename" class="col-sm-6 col-form-label"><b>Name</b></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control col-sm-12" value="<?php echo $expensename;  ?>" id="expensename" name="expensename">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                            
                            <!-- For drop down list of categories, if it matches the database, then it is selected on the form
                             -->
                             
                            <fieldset class="form-group">
                                 <div class="row">
                                     <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                     <div class="col-md">

                                        <select class="form-control" name="expensecategory" required>

                                            <option value="none" selected>Select a category</option>
                                            <option value="Health"<?php if($expensecategory == "Health"){ echo " selected='selected'"; } ?>>Health </option>
                                            <option value="Food"<?php if($expensecategory == "Food"){ echo " selected='selected'"; } ?>>Food </option>
                                            <option value="Fun"<?php if($expensecategory == "Fun"){ echo " selected='selected'"; } ?>>Fun </option>
                                            
                                            <option value="Savings"<?php if($expensecategory == "Savings"){ echo " selected='selected'"; } ?>>Savings</option>
                                            <option value="Rent"<?php if($expensecategory == "Rent"){ echo " selected='selected'"; } ?>>Rent</option>
                                            <option value="Other"<?php if($expensecategory == "Other"){ echo " selected='selected'"; } ?>>Other</option>
                                            
                                            <option value="Utilities"<?php if($expensecategory == "Utilities"){ echo " selected='selected'"; } ?>>Utilities </option>
                                        </select>

                                     </div>
                                 </div>
                             </fieldset>

                             <div class="form-group row">
                                <label for="expensenote" class="col-sm-6 col-form-label"><b>Note</b></label>
                                <div class="col-md-6">
                                
                                    <!-- <input type="text" class="form-control col-sm-12" value="<?php //echo $expensenote;  ?>" id="expensenote" name="expensenote"> -->

                                    <!-- Note textarea will submit to database, edit a record in database, but will not output from database to textarea.  using input type="text" works normally.  come back to this later. -->
                                    
                                    <textarea type="text" class="form-control" name="expensenote" rows="3" value="<?php echo $expensenote;?>"></textarea>
                                    
                                </div>
                            </div>
                            
                            <!-- Display buttun for cancel, add, edit and delete -->

                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <a class="btn btn-md btn-light" href="http://localhost:8888/Finance/index.php">Cancel</a>
                                        <button class="btn btn-md btn-warning" type="submit" name="update">Update</button>
                                    <?php elseif ($del == true) : ?>
                                        <a class="btn btn-md btn-light" href="http://localhost:8888/Finance/index.php">Cancel</a>
                                        <button class="btn btn-md btn-danger" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <a class="btn btn-md btn-light" href="http://localhost:8888/Finance/index.php">Cancel</a>
                                        <button class="btn btn-md btn-success" type="submit" name="delete">Add</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
                <!-- row -->
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
        feather.replace();
    </script>
    <script>

    </script>
      <?php display_footer();?>

</body>
</html>