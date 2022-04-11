<?php include("session.php"); ?>
<?php include "templateHtmlCssJs.php" ?>
<?php template_header("Search Page");?>
<!-- loads custom styling -->
<link href="css/search.css" rel="stylesheet">

<?php display_header();?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search-php.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
</head>
<body>

<div class="search-box">
    <form action="" method="POST" autocomplete="off">
      <h4 class="text-center">AJAX Search</h4>
      <div class="form-group">
        <div class="col text-center"><br>
            <a href="manage_expense.php"><img src="icon/maex.png" width="57px" /></a>
        </div><br>
        <input type="text" autocomplete="off" placeholder="Search expense...">
        <div class="result"></div>
      </div>
      
    </form>
</div>

<?php display_footer();?>
</body>
</html>



