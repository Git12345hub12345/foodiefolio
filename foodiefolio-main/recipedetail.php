<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="recipedetail.css">
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
    <h1>Recipe details</h1>
       <a href="index.php"><img src="images/elgato.png" alt="muffi" class="muffin"></a>
        <h1 class="head">foodiefolio</h1>
    </div>
    <div class="main">
    <div class="block1">
    <div class="images">
    <?php
    $data=$_GET['recipeid']??null;

    $bdc="SELECT * FROM recipe where recipeid=$data";
    $asd=mysqli_query($con,$bdc);
    if($asd)
    {
        if($asd->num_rows>0)
        {
            while($p=$asd->fetch_assoc()){
                echo '<img src="' . $p['image_url'] . '">';
            }
        }
    }
    ?></div>
    <button type="submit" id="myButton">Add mealplan</button>
    <div class="popup" id="myPopup">
        <div class="popup-content">

        <form action="" id="mealForm" method="post">
            <label for="day">Select Day:</label>
            <select name="day" id="day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            
            <button type="submit" name="cloPopup" id="closePopup">Add</button>
                
</form>
       <?php
include("connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_day = $_POST['day'];

    $recipe_id = $_GET['recipeid'] ?? null;
    $recipe_title = null;

    $recipe_query = "SELECT title FROM recipe WHERE recipeid = $recipe_id";
    $recipe_result = mysqli_query($con, $recipe_query);

    if ($recipe_result && mysqli_num_rows($recipe_result) > 0) {
        $row = mysqli_fetch_assoc($recipe_result);
        $recipe_title = $row['title'];
    }

    $insert_query = "INSERT INTO meal (recipeid, mname, days) VALUES ('$recipe_id', '$recipe_title', '$selected_day')";
    $insert_result = mysqli_query($con, $insert_query);

    if($insert_result) { 
        echo '<script>alert("Recipe added to meal plan successfully!");</script>';
    } else {
        echo '<script>alert("Error: Unable to add recipe to meal plan.");</script>';
    }
}
?>
    </div>
    </div>
    </div>
    <div class="block2">
    <?php
    $data=$_GET['recipeid'];

    $bdc="SELECT * FROM recipe where recipeid=$data";
    $sql="SELECT * FROM instructions where recipeid=$data";
    $abc="SELECT * from ingredients where recipeid=$data";
    $result=mysqli_query($con,$sql);
    $ahu=mysqli_query($con,$abc);
    $haha=mysqli_query($con,$bdc);
    if($haha){
        if($haha->num_rows>0){
            while($t=$haha->fetch_assoc()){
        echo '<div class="heading">
        <h2 class="tname">'.$t['title'].'</h2>
        </div>';
    }
    }
    }
    if($ahu){
        if($ahu->num_rows>0){
            echo '<h3 class="ing">Ingredients required</h3>';
            while($r=$ahu->fetch_assoc()){
                echo "<ul>";
                echo '<div class="ingdetail"><li>'. $r['ingname'].' - '.$r['quantity'].'</li></div>';
                echo "</ul>";
    
            }
        }
    }
    ?></div>
    </div>
    <div class="block3">
    <?php
    if($result){
        if($result->num_rows>0){
            echo '<h3 class="ing">Cooking Instructions</h3>';
        while($row=$result->fetch_assoc()){
           
            echo '<div class="ingdetail"><p>'.$row['stepnum'].' . '.$row['insttxt'].'</p></div>';

        }

    }
    }
    else{
        echo "No result found";
    }
    ?></div>
    
    

<script>
    myButton.addEventListener(
                "click",
                function () {
                    myPopup.classList.add("show");
                }
            );
            closePopup.addEventListener(
                "click",
                function () {
                    myPopup.classList.remove(
                        "show"
                    );
                }
            );
            window.addEventListener(
                "click",
                function (event) {
                    if (event.target == myPopup) {
                        myPopup.classList.remove(
                            "show"
                        );
                    }
                }
            );

</script>
</body>
</html>

