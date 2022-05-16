<?php
  include("session.php");
  // Sum of expenses per category for all time. Used for bar chart
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  // Sum of expenses per category for all time. Used for pie chart
  $exp_category_dc2 = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc2 = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  // TBA
  $exp_category_dc3 = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc3 = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");


  // Sum of expeneses per category for the last 30 days (does not work)
  // $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' AND expensedate > NOW() - INTERVAL 30 GROUP BY expensecategory");
  // $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' AND expensedate > NOW() - INTERVAL 30 GROUP BY expensecategory");

  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  
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

  $testQuery = mysqli_query($con, "SELECT year(expensedate), month(expensedate), sum(expense) FROM expenses WHERE user_id = 7 GROUP BY year(expensedate), month(expensedate)");


 
  $expenses_last_30_days = mysqli_query($con, "SELECT COUNT(*) from expenses WHERE expensedate > NOW() - INTERVAL 30 day AND user_id = '$userid'");
  $expenses_last_30_days_output = $expenses_last_30_days->fetch_array()[0] ?? '';

  $placeholder = "0";
?>


<?php include "template.php" ?>
<?php template_header("Home Page");?>
<?php display_header();?>
<style><?php include 'css/style.css'; ?></style>

<body>

  <div class="d-flex" id="wrapper">

    <?php display_sidebar();?>



    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php display_secondary_nav(); ?>

      
      <div class="container-fluid">
        <h3 class="mt-4">Dashboard</h3>

        <?php display_dashboard_buttons(); ?>
       
        <h4 class="mt-4">Statistics</h4>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">All-time spending by category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie2" height="150"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">All-time spending by category</h5>
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
                <h5 class="card-title text-center">Placeholder</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie4" height="150"></canvas>
              </div>
            </div>
          </div>
        </div>
     

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
              <canvas id="expense_category_pie3" height="150"></canvas>
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

       
        </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <?php  print_r($testQuery); ?>
      
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

    // Bar Chart

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
            '#154360',
            '#1E8449',
            '#DAF7A6',
            '#FFC300',
            '#FF5733',
            '#C70039',
            '#ABB2B9',
            '#5B2C6F',
            '#F4F6F7',
            '#566573'
          ],
          borderWidth: 1
        }]
      }
    });

    // Line Chart

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
            '#154360',
            '#1E8449',
            '#DAF7A6',
            '#FFC300',
            '#FF5733',
            '#C70039',
            '#ABB2B9',
            '#5B2C6F',
            '#F4F6F7',
            '#566573'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });

    
    // Pie Chart

    var ctx = document.getElementById('expense_category_pie2').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc2)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc2)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
          backgroundColor: [
            '#154360',
            '#1E8449',
            '#DAF7A6',
            '#FFC300',
            '#FF5733',
            '#C70039',
            '#ABB2B9',
            '#5B2C6F',
            '#F4F6F7',
            '#566573'
          ],
          borderWidth: 1
        }]
      }
    });

   
    //Replace dynamic labels and data with hard code ones following ChartJS example
    var ctx = document.getElementById('expense_category_pie4').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['January',
                'February',
                'March',
                'April',
                'May',
                'June',
        ],
        datasets: [{
          label: 'My First dataset',
          data: [0, 10, 5, 2, 20, 30, 45],
          backgroundColor: [
            '#154360',
            '#1E8449',
            '#DAF7A6',
            '#FFC300',
            '#FF5733',
            '#C70039',
            '#ABB2B9',
            '#5B2C6F',
            '#F4F6F7',
            '#566573'
          ],
          borderWidth: 1
        }]
      }
    });


 // Doughnut Chart with real date

 var ctx = document.getElementById('expense_category_pie3').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc3)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc3)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
          backgroundColor: [
            '#154360',
            '#1E8449',
            '#DAF7A6',
            '#FFC300',
            '#FF5733',
            '#C70039',
            '#ABB2B9',
            '#5B2C6F',
            '#F4F6F7',
            '#566573'
          ],
          borderWidth: 1
        }]
      }
    });
   
  </script>
<?php display_footer();?>

</body>

</html>