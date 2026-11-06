<?php
include("connection.php");

$query = "SELECT * FROM meal";
$result = mysqli_query($con, $query);

$shopping_list = array();

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
        $recipe_id = $row['recipeid'];
        $ingredient_query = "SELECT * FROM ingredients WHERE recipeid = $recipe_id";
        $ingredient_result = mysqli_query($con, $ingredient_query);

        while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
            $ingredient_name = $ingredient_row['ingname'];

            $shopping_list[$ingredient_name]= true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping list</title>
  <link rel="stylesheet" href="shoppinglist.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
<div class="title">
  <h1>Shopping list</h1>
  <a href="index.php"><img src="images/elgato.png" alt="muffi" class="muffin"></a>
  <h1 class="head">foodiefolio</h1>

  
</div>
<div class="boxes">
<?php
        foreach ($shopping_list as $ingredient => $value) {
            echo "<label class='lists'><input type='checkbox' class='box'>$ingredient</label><br>";
        }
        ?>
        </div>
</body>
</html>
