<!DOCTYPE html>
<title> CookingPro </title>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="alphastyles.css"> <!-- css -->
    <link rel="stylesheet" href="normalize.css"> <!-- margins -->
    <script type="text/javascript" src=alphascript.js></script> <!-- javascript -->
</head>
<?php  include 'htdocs/db.php';

if (isset($_POST['submit'])) {
    $table = 'recipes';
    //echo "User clicked on submit";
    $search = $_POST['search'];
    // select everything from table
    $query = "SELECT * FROM {$table} WHERE tle LIKE '%{$search}%' OR subtitle LIKE '%{$search}%'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die ('Database query failed');
    }
} else {
    $table = 'recipes';
    $query = "SELECT * FROM {$table}";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die ('Database query failed');
    }
}
?>

    <body>
        <!-- sticky header with the text "CookingPro" -->
        <header>
            <h1> CookingPro </h1>
                <!-- navigation -->
                    <ul class="navigation">
                        <li>
                            <a href="alpha.php">HOME</a>
                        </li>
                        <li>
                            <a href="menu.php">MENU</a>
                        </li>
                        <li>
                            <a href="help.html">HELP</a>
                        </li>
                    </ul>

                <!-- search bar -->
                <form class="formsearch" action="menu.php" method="POST">
                    <input type="text" placeholder="Search..." name="search" class="inputsearch">
                    <input type="submit" name="submit" value="Submit">
                </form>
                </header> <!-- closing tag for sticky header -->

            <!-- yellow background -->
            <div class="recipesection">
                <!-- white background -->
                        <div class="whitebg">
                            <div class="centercontent">
                                    <!-- link to recipe -->
                                    <a href="recipe.php">
                                        
                                     <?php  

                                        // grab info from database and display 3 rows randomly
                                        $sql = "SELECT id, tle, subtitle, `description`, cook_time, cal_per_serving, main_img FROM `recipes`";
                                        $result = $connection->query($sql);

                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                    
                                

                                        // <!-- recipe (the whole container) -->
                                        echo "<div class='recipe'>";

                                        //  <!-- food image -->
                                        echo  "<div class='recipeimg'>";

                                        echo   "<img src=Images/{$row["main_img"]}>";

                                        echo "</div>";
                                    
                                        // container for recipe txt 
                                        echo "<div class='recipeinfo'>";
                                        // <!-- recipe name -->
                                        echo "<div class='recipetxt'>";
                                                
                                        echo "<h2><a href=recipe.php?id={$row['id']}>{$row['tle']}</a></h2>";
                                        
                                        echo "</div>";
                                        
                                        echo "<div class='extradetails'>";

                                        // <!-- time it takes to cook food -->
                                        echo "<div class='time'>";

                                        echo "<img src='Images/clockicon.jpg' width='20px' height='20px'>";
                                        
                                        echo  "<h3>{$row["cook_time"]}</h3>";

                                        echo "</div>";
                                        
                                        // <!-- amount of calories -->
                                        echo "<div class='calories'>";

                                        echo "<img src='Images/caloriesicon.jpg' width='20px' height='20px'>";

                                        echo "<h3>{$row["cal_per_serving"]}</h3>";

                                        echo "</div>";

                                        echo "</div>"; // <!-- closing tag for "recipe info" -->

                                        echo "</div>"; // <!-- closing tag for "extra details " -->

                                        echo "</div>";

                                        echo "<br></br>";
                                        // <!-- closing tag for "recipe" -->
                                        

                                        //echo "id: " . $row["id"]. " tle: " . $row["tle"]. "<br>" ;
                                        // . $row["tle"]. " " . $row["lastname"]. "<br>";
                                        }
                                        } else {
                                        echo "0 results";
                                        }
                                        $conn->close();

                                        echo "</a>";
                                    ?> 
                                </a>
 
                            </div> <!-- closing tag for "centercontent"-->
                        </div> <!-- closing tag for "whitebg" -->

            </div>
    </body>
</head>
</html>
