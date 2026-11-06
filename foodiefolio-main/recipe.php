<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="recipe.css">
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
    <h1>Recipes</h1>
       <a href="index.php"><img src="images/elgato.png" alt="muffi" class="muffin"></a>
        <h1 class="head">foodiefolio</h1>
    </div>
<div class="recipe-thumbnails">
        <?php
        $res="SELECT * from recipe";
        $asd=mysqli_query($con,$res);
        $recipe=[];
        if($asd->num_rows>0)
        {
            while($row = $asd->fetch_assoc()) {
                $recipe[] = $row;
            }
        }
        ?>
    <?php foreach ($recipe as $recipes): ?>
        <div class="recipe-thumbnail">
            <img src="<?php echo $recipes['image_url']; ?>" alt="<?php echo $recipes['title']; ?>">
            <h3><?php echo $recipes['title']; ?></h3>
            <a href="recipedetail.php?recipeid=<?php echo $recipes['recipeid']; ?>">View Recipe</a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>