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
    <title>foodiefolio
    </title>
    <link rel="stylesheet" href="index.css">
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
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lugrasimo&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<h1></h1>
<body>
    <div class="sabai">
    <div class="options">
        <a href="recipe.php">Recipes</a>
        <a href="shoppinglist.php">Shopping list <img src="images/cart.png" alt="cart" id="cart"></a>
        <a href="mealplan.php">Meal Plans</a>
    </div>
   <div class="searchclass">
        <form method="post" >
        <input type="text" name="search" placeholder="Search Recipes" class="searchbutt">
        <button type="submit" name="searchdata" class="butt">
            <img src="images/searchbutton.png" alt="searchicon" class="seicon">
        </button>
    </form>
    <div class="container">
        <table class="table">
        <?php
        if (isset($_POST['searchdata'])){
            $searchdd=$_POST['search'];
            $sql="SELECT * from recipe where title like '%$searchdd%'";
            $result=mysqli_query($con,$sql);
            if($result)
           {
            if(mysqli_num_rows($result)>0){
              echo '<thead>
                <tr>
                <th>RECIPE</th>
                </tr> 
                </thead>';
                while($row=mysqli_fetch_assoc($result)){
                    echo '<tbody>
                        <tr>
                        <td><a href="recipedetail.php?recipeid='.$row['recipeid'].'">'.$row['title'].'</td>
                        </tr>
                        </tbody>';
                }
            }
            }
            else{
                echo '<h2>Data not found</h2>';
            }
        }   
        ?>
        </table>
    </div>
    </div>

    <div class="dropdown">
        <button onclick="myfunction()" class="dropbtn">
          <img src="images/uicon.png" alt="uicon" id="icon">
        </button>
        <div class="dropdown-content" id="thedropdown">
            <?php echo $_SESSION['username']; ?>
          <a style="text-decoration: none;" href="logout.php">Log out</a>
        </div>
    </div>
    </div>
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
    </script>
    <div>
        <img src="images/elgato.png" alt="muffi" class="muffin">
    </div>
    <div class="title">
        foodiefolio
    </div>

    <div>
        <h4>Welcome to Foodiefolio, your ultimate destination for seamless meal planning and culinary inspiration! Embark on a delicious journey with us as we simplify your kitchen adventures, helping you craft delightful meals and elevate your dining experiences effortlessly.</h4>
    </div>


    <footer>
        <p>&copy; 2024 foodiefolio</p>
    </footer>
</body>
</html>
