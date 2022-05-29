<?php
  include("../session.php");
  

  //Average amount spent for last 30 days 
  //SELECT AVG(expense) FROM expenses WHERE user_id = 7 AND expensedate >= (CURDATE() - INTERVAL 1 MONTH)
  //min
  //max
 
  // SELECT SUM(expense), expensename FROM expenses WHERE user_id = 7 AND expensedate >= (CURDATE() - INTERVAL 1 MONTH) GROUP BY expensename

  // SELECT SUM(expense), expensecategory FROM expenses WHERE user_id = 7 AND expensedate >= (CURDATE() - INTERVAL 1 MONTH) GROUP BY expensecategory

  // SELECT SUM(expense), expensedate FROM expenses WHERE user_id = 7 AND expensedate >= (CURDATE() - INTERVAL 1 MONTH) GROUP BY expensedate

  // SELECT COUNT(expense), expensecategory FROM expenses WHERE user_id = 7 AND expensedate >= (CURDATE() - INTERVAL 1 MONTH) GROUP BY expensecategory

  // SELECT COUNT(expense) AS 'Times', expensecategory FROM expenses WHERE user_id = 7 AND expensedate >= (CURDATE() - INTERVAL 1 MONTH) GROUP BY expensecategory


  // Bar chart
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' AND expensedate >= (CURDATE() - INTERVAL 1 week) GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  // Pie chart 
  $exp_category_dc2 = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc2 = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid'  GROUP BY expensecategory");

  $exp_category_dc3 = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc3 = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");


  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");

  $exp_date_line2 = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line2 = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  
  // total spent all time
  $total_spent_last_7_days = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid'");
  $total_spent_last_7_days_output = $total_spent_last_7_days->fetch_array()[0] ?? '';

 
  $expenses_last_7_days = mysqli_query($con, "SELECT COUNT(*) from expenses WHERE user_id = '$userid'");
  $expenses_last_7_days_output = $expenses_last_7_days->fetch_array()[0] ?? '';

  // Max spent
  $max_spent = mysqli_query($con, "SELECT MAX(expense) FROM expenses WHERE user_id = '$userid'");
  $max_spent_output = $max_spent->fetch_array()[0] ?? '';

  //Avg spent
  $avg_spent = mysqli_query($con, "SELECT AVG(expense) FROM expenses WHERE  user_id = '$userid'");
  $avg_spent_output = number_format($avg_spent->fetch_array()[0] ?? '');
?>


<?php include "../template.php" ?>
<?php html_template("Report Page");?>
<?php display_header();?>
<style><?php include '../../css/style.css'; ?></style>

<body>

  <div class="d-flex" id="wrapper">

    <?php display_reports_sidebar();?>



    <!-- Page Content -->
    <div id="page-content-wrapper">

    <?php display_secondary_nav(); ?>

      
      <div class="container-fluid">
        <h3 class="mt-4">Dashboard</h3>
        <?php display_reports_dashboard_buttons(); ?>
        </div>

        <h4 class="mt-4">Statistics</h4>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Total Transactions - All Time</h5>
              </div>
              <div class="card-body">
                <h3 class="text-center"> <?php  echo $expenses_last_7_days_output ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Total Spent - All Time</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo "$ ". $total_spent_last_7_days_output ?></h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Max expense - All Time</h5>
              </div>
              <div class="card-body">
                <h3 class="text-center"> <?php  echo "$ ". $max_spent_output ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Average expense - All Time</h5>
              </div>
              <div class="card-body">
              <h3 class="text-center"> <?php  echo "$ ". $avg_spent_output ?></h3>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Pie Chart - All Time</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie2" height="150"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Bar Chart - All Time</h5>
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
                <h5 class="card-title text-center">Line Graph - All Time</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_line" height="150"></canvas>
              </div>
            </div>
          </div>
        

          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Alternative Line Graph - All Time</h5>
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
                <h5 class="card-title text-center">Doughnut Chart - All Time</h5>
              </div>
              <div class="card-body">
              <canvas id="expense_category_pie3" height="150"></canvas>
              </div>
            </div>
          </div>
          
        </div>

       
        </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
      
  <?php load_reports_scripts(); ?>
  
  <script>

    // Bar Chart for last 30 days

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

    
    // Pie Chart of the last 30 days

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

    
   
    // Alternative line chart
    var ctx = document.getElementById('expense_category_pie4').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
      labels: [<?php while ($c = mysqli_fetch_array($exp_date_line2)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Month',
          data: [<?php while ($d = mysqli_fetch_array($exp_amt_line2)) {
                    echo '"' . $d['SUM(expense)'] . '",';
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


 // Doughnut Chart for last 30 days

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




</head>
</html>