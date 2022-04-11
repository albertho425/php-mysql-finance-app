<?php include "templateHtmlCssJs.php" ?>
<?php template_header("Search Page");?>
<!-- loads custom styling -->
<link href="css/search.css" rel="stylesheet">



<body>

<div class="">
    <form method="POST" action="search-php.php">
      <h4 class="text-center">Search</h4>
      <div class="form-group">
        <div class="col text-center"><br>
            <a href="manage_expense.php"><img src="icon/maex.png" width="57px" /></a>
        </div><br>
        <input type="text" name="search" placeholder="Search expense name...">
        <input type="submit" class="btn btn-success btn-sm">
      </div>
      
    </form>
</div>

<?php display_footer();?>
</body>
</html>



