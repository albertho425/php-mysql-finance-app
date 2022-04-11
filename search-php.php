<?php include "session.php"?>
<?php include "templateHtmlCssJs.php" ?>
<?php template_header("Search Page");?>

<!-- loads custom styling -->
<link href="css/search.css" rel="stylesheet">


<?php
$search = $_POST['search'];
$link = mysqli_connect("localhost", "root", "root", "dailyexpense");

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

    // Prepare a select statement
    $sql = "SELECT * FROM expenses WHERE expensename LIKE '%$search%' OR expensecategory LIKE '%$search%'";
    
    $result = $link->query($sql);
            
    if ($result->num_rows > 0) {

        echo "<table class='table table-md'><thead>
            <tr>
            <th scope='col'>Date</th>
            <th scope='col'>Category</th>
            <th scope='col'>Amount</th>
            <th scope='col'>Name</th>
            <th colspan='2'>Action</th>
            </tr></thead>";

            while($row = $result->fetch_assoc() ){                

            echo "<tr><td>".$row["expensedate"]."</td>".
            "<td>". $row["expensecategory"]."</td>".
            "<td>".$row["expense"]."</td>".
            "<td>".$row["expensename"]."</td>" .
            "</tr>";            
        }
    } 
    else {
        echo "<p>No matches found</p>";
    }
       
    echo "</table>";
     

$link->close();
display_footer();
?>