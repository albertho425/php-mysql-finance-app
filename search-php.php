<?php include("session.php"); ?>


<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "root", "dailyexpense");

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM expenses WHERE expensecategory LIKE ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array

                echo "<table class='table table-md'><thead>
                    <tr>
                    <th scope='col'>Date</th>
                    <th scope='col'>Category</th>
                    <th scope='col'>Amount</th>
                    <th scope='col'>Name</th>
                    </tr></thead>";

                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                    echo "<tr><td>".$row["expensedate"]."</td>".
                    "<td>". $row["expensecategory"]."</td>".
                    "<td>".$row["expense"]."</td>".
                    "<td>".$row["expensename"]."</td>" .
                    "</tr>";
                    
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    echo "</table>";
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>
