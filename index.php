<?php
  include("session.php");
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY month(expensedate)");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY month(expensedate)");

  //$numberOfTransactions = mysqli_query($con, "SELECT COUNT(*) FROM expenses WHERE user_id = '$userid'");
  $total_spent = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid'");
  //access the object colum index 0 or associative key
  $total_amount = $total_spent->fetch_array()[0] ?? '';

  // number of total expense entries for a user
  $result = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");
  // convert object to string
  $count = mysqli_num_rows($result);
  
  // total spent in last 30 days
  $total_spent_last_30_days = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE expensedate > NOW() - INTERVAL 30 day AND user_id = '$userid'");
  $total_spent_last_30_days_output = $total_spent_last_30_days->fetch_array()[0] ?? '';

  $avg_spent_per_month = mysqli_query($con, "SELECT month(expensedate), avg(expense) from expenses group by month(expensedate) AND user_id = '$userid'");
  //$avg_spent_per_month_output = $avg_spent_per_month->fetch_array()[0] ?? '';


 
  $expenses_last_30_days = mysqli_query($con, "SELECT COUNT(*) from expenses WHERE expensedate > NOW() - INTERVAL 30 day AND user_id = '$userid'");
  $expenses_last_30_days_output = $expenses_last_30_days->fetch_array()[0] ?? '';

  $placeholder = "0";
?>


<?php include "templateHtmlCssJs.php" ?>
<?php template_header("Home Page");?>
<?php display_header();?>


  <style>
    .card a {
      color: #000;
      font-weight: 500;
    }

    .card a:hover {
      color: #28a745;
      text-decoration: dotted;
    }
  </style>

<!-- </head> -->

<body>

  <div class="d-flex" id="wrapper">

    <?php display_sidebar();?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      
      <div class="container-fluid">
        <h3 class="mt-4">Dashboard</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col text-center">
                    <a href="add_expense.php"><img src="icon/money-3.png" width="57px" />
                      <p>Add Expenses</p>
                    </a>
                  </div>
                  
                  <div class="col text-center">
                    <a href="manage_expense.php"><img src="icon/money-2.png" width="57px" />
                      <p>Edit Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="profile.php"><img src="icon/user.png" width="57px" />
                      <p>User Profile</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="logout.php"><img src="icon/logout.png" width="57px" />
                      <p>Logout</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h4 class="mt-4">Statistics</h4>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Total Transactions</h5>
              </div>
              <div class="card-body">
                <h3 class="text-center"> <?php  echo $count; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Total Spent</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo "$ ". $total_amount; ?></h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Total Transactions last 30 days</h5>
              </div>
              <div class="card-body">
                <h3 class="text-center"> <?php  echo $expenses_last_30_days_output ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Total Spent last 30 days</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo "$ ". $total_spent_last_30_days_output ?></h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Placehlder</h5>
              </div>
              <div class="card-body">
                <h3 class="text-center"> <?php echo $placeholder;?></h3>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Placeholder</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo $placeholder; ?></h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Monthly Expenses</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_line" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Expense Category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie" height="150"></canvas>
              </div>
            </div>
          </div>
        </div>
       

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Placeholder</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo $placeholder; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Placeholder</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo $placeholder; ?></h3>
              </div>
            </div>
          </div>
        </div>
       


      
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
    // All elements that have a data-feather attribute will be replaced with SVG markup corresponding to their data-feather attribute value.
    feather.replace()
  </script>
  <script>
    var ctx = document.getElementById('expense_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          borderWidth: 1
        }]
      }
    });

    var line = document.getElementById('expense_line').getContext('2d');
    var myChart = new Chart(line, {
      type: 'line',
      data: {
        labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Month',
          data: [<?php while ($d = mysqli_fetch_array($exp_amt_line)) {
                    echo '"' . $d['SUM(expense)'] . '",';
                  } ?>],
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });
  </script>


</div>
    </div>
    <!-- /#page-content-wrapper -->

    
  </div>
  <!-- /#wrapper -->
</body>

</html>