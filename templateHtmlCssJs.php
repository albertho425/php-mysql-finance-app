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

    <div class="pos-f-t">
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h4 class="text-white">Navigation Bar</h4>
            <span class="text-muted">Add menu items here</span>
        </div>
      </div>
      <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </div>

    <title>$title</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">


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
  <nav class="navbar fixed-bottom navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Daily Expense Application</a>
  </nav>

  EOT;

}

?>

