<?php
session_start();
include("connection.php");
if(!isset($_SESSION["username"])){
    echo "milena";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin
    </title>
    <link rel="stylesheet" href="dash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<h1></h1>
<body>
    <div class="toptop">
<div class="title">
       <a href="dash.php"><img src="images/elgato.png" alt="muffi" class="muffin"></a>
        <h1 class="head">foodiefolio</h1>
        
    </div>
    <div class="view">
            <a href="allrecipe.php">View recipes</a>
        </div>
    <div class="dropdown">
        <button onclick="myfunction()" class="dropbtn">
          <img src="images/uicon.png" alt="uicon" id="icon">
        </button>
        <div class="dropdown-content" id="thedropdown">
            <?php echo $_SESSION['username']; ?>
          <a style="text-decoration: none;" href="adminlogout.php">Log out</a>
        </div>
    </div>
</div>
<form action="" method="post">
    <h3>Add Recipe to database</h3>
<div class="labels">
    Title:
    <br><input type="text" placeholder="Enter recipe title" id="restit" name="title" required class="abc">
</div>

<div class="labels">
    image URL:
    <br>
    <input type="text" placeholder="enter image url" id="url" name="imgurl" required class="abc">
</div>
<h4>Ingredients:</h4>
        <div id="ingredient_fields" class="labels">
            <br><input type="text" name="ingredient[]" placeholder="ingredient" required class="abc">
            <input type="text" name="quantity[]" placeholder="quantity" required class="abc">
            </div>
        <button type="button" onclick="addIngredientField()">Add Ingredient</button>

<h4>Instructions</h4>
<div id="instruction_fields" class="labels">
            <br><input type="number" name="stepnum[]" placeholder="stepnumber" required class="abc">
            <input type="text" name="instruction[]" placeholder="instruction text" required class="abc">
            </div>
        <button type="button" onclick="addInstructionField()">Add Instructions</button>
<button type="submit" name="add" class="buttstyle">Save this recipe</button>

</form>


<?php
if(isset($_POST['add'])){
    $title=$_POST['title'];
    $img=$_POST['imgurl'];

    $ingname=$_POST['ingredient'];
    $quantity=$_POST['quantity'];

    $snum=$_POST['stepnum'];
    $instructions=$_POST['instruction'];
    
    $sql_recipe="INSERT INTO `recipe`(`title`, `image_url`) VALUES ('$title','$img')";

    if($con->query($sql_recipe)=== true){
        $recipe_id = $con->insert_id;

        for($i = 0; $i < count($ingname); $i++){
            $ingredient = $ingname[$i];
            $qty = $quantity[$i];
            $sql_ingredient="INSERT INTO `ingredients`(`ingname`, `quantity`, `recipeid`) VALUES ('$ingredient','$qty','$recipe_id')";
        if ($con->query($sql_ingredient) !== TRUE) {
            echo "Error inserting ingredient: " . $conn->error;
        }}

        for($j = 0; $j < count($snum); $j++){
            $stepnum = $snum[$j];
            $instruction = $instructions[$j];
            $sql_instruction="INSERT INTO `instructions`(`recipeid`, `stepnum`, `insttxt`) VALUES ('$recipe_id','$stepnum','$instruction')";
        if ($con->query($sql_instruction) !== TRUE) {
            echo "Error inserting instruction: " . $conn->error;
        }
    }
        
        echo "Recipe added successfully";
        
    }else {
        echo "Error";
    }
}
?>







    <script>
        function myfunction(){
            document.getElementById("thedropdown").classList.toggle("show");
        }
        
        window.onclick=function(event){
            if(!event.target.matches('.dropbtn')){
                var dropsdown=document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function addIngredientField() {
    var container = document.getElementById("ingredient_fields");
        var div = document.createElement("div");

        var inputName = document.createElement("input");
        inputName.type = "text";
        inputName.name = "ingredient[]";
        inputName.placeholder = "Ingredient Name";
        inputName.required = true;

        var inputQuantity = document.createElement("input");
        inputQuantity.type = "text";
        inputQuantity.name = "quantity[]";
        inputQuantity.placeholder = "Quantity";
        inputQuantity.required = true;

        div.appendChild(inputName);
        div.appendChild(inputQuantity);
        container.appendChild(div);
        }

        function addInstructionField() {
            var container = document.getElementById("instruction_fields");
        var div = document.createElement("div");

        var inputStepNum = document.createElement("input");
        inputStepNum.type = "number";
        inputStepNum.name = "stepnum[]";
        inputStepNum.placeholder = "Step Number";
        inputStepNum.required = true;

        var inputInstruction = document.createElement("input");
        inputInstruction.type = "text";
        inputInstruction.name = "instruction[]";
        inputInstruction.placeholder = "Instruction Text";
        inputInstruction.required = true;

        div.appendChild(inputStepNum);
        div.appendChild(inputInstruction);
        container.appendChild(div);
        }
    </script>
</body>
</html>
