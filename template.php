<?php 
/**
 *  Load HTML, Header Nav Bar, CSS, and JS and output the title of the page
 *
 * @param [type] $title
 * @return void
 */

function template_header($title) {

echo <<<EOT

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>$title</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>



</head>
EOT;


/**
 * Removes whitespace, backslashes, and concerts some predefined characters to HTML
 *
 * @param [type] $data
 * @return void
 */
function data_check($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

}

/**
 * Display a footer on each page
 */

function display_footer() { 

  echo <<<EOT
  <nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Daily Expense Application</a>
  </nav>

  EOT;

}

function display_header() {
  
  echo <<<EOT
  <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark p-4">
        <h4 class="text-white"></h4>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/">Home</a>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/add_expense.php">Add an expense</a>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/manage_expense.php">Edit an expense</a>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/search.php">Search expense</a>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/profile.php">Profile</a>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/logout.php">Logout</a>
        <a class="nav-item nav-link" href="http://localhost:8888/Finance/login.php">Login</a>
      </div>
    </div>
      
    <nav class="navbar navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  </div>

  EOT;
}

function display_sidebar() {


  echo <<<EOT
  <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
           
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
              <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span> Dashboard</a>
              <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
              <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span>Edit Expenses</a>
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
              <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
              <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
          </div>
  <!-- /#sidebar-wrapper -->

  EOT;

}

function display_secondary_nav() {

  echo <<<EOT
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
      <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
        <span data-feather="menu"></span>
     </button>           
    </nav>

  EOT;
}

?>

