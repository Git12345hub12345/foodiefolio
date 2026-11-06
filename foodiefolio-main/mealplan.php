<?php
include("connection.php");


if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM meal WHERE mealID = '$delete_id'";
    $delete_result = mysqli_query($con, $delete_query);
    if($delete_result) {
        header("Location: mealplan.php");
        exit();
    } else {
        echo "<p>Error: Unable to delete meal plan entry.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Plan</title>
    <link rel="stylesheet" href="mealplan.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lugrasimo&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="title">
        <h1>Meal Plan</h1>
        <a href="index.php"><img src="images/elgato.png" alt="muffi" class="muffin"></a>
        <h1>foodiefolio</h1>
    </div>

    
    <table class="tab">
        <thead class="head">
            <tr>
                <th>Day</th>
                <th>Meal</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bod">
            <?php
            $query = "SELECT * FROM meal ORDER BY FIELD(days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $meals_by_day = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $day=$row['days'];
                    if (!isset($meals_by_day[$day])) {
                        $meals_by_day[$day] = [];
                    }
                    $meals_by_day[$day][] = $row;
                }

                foreach ($meals_by_day as $day => $meals) {
                    ?>
                    <tr>
                        <td rowspan="<?php echo count($meals); ?>"><?php echo $day; ?></td>
                        <?php
                        $first = true;
                        foreach ($meals as $meal) {
                            if ($first) {
                                $first = false;
                            } else {
                                echo "<tr>";
                            }
                            ?>
                            <td><?php echo $meal['mname']; ?></td>
                            <td>
                                <a href="mealplan.php?delete_id=<?php echo $meal['mealID']; ?>" onclick="return confirm('Are you sure you want to delete this entry?')">
                                    <img src="images/deleteicon.png" alt="delicon" class="delicon">
                                </a>
                            </td>
                            </tr>
                            <?php
                        }
                    }
                }else {
                echo "<tr><td colspan='4'>No meal plan data available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
