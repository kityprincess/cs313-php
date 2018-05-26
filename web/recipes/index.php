<?php
/**********************************************************
* File: index.php
* Author: Kimberly Stowe, based off Br. Burton's
*         viewScriptures file
* 
* Description: Queries PostgreSQL database from PHP.
***********************************************************/
$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Heirloom Recipes</title>
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
</head>

<body>
<h1>Recipes</h1>

<p>
    <div class = aboutUs>
    Heirloom Recipes is a place where you can store all <strong><em>YOUR</em></strong> favorite recipes!<br/>
    Everything from your grandma's famous pizza to ants on a log for your little one.<br/>
    We make storing and searching your recipes easy.<br/>
    You can search on your recipe's name, ingredients, category, you name it!<br/>
    Heirloom Recipes is uniquely <strong><em>YOURS</em></strong>!
    </div>
    <br/>
    <br/>
</p>
<?php
// In this example, for simplicity, the query is executed
// right here and the data echoed out as we iterate the query.
// You could imagine that in a more involved application, we
// would likely query the database in a completely separate file / function
// and build a list of objects that held the components of each
// scripture. Then, here on the page, we could simply call that 
// function, and iterate through the list that was returned and
// print each component.
// First, prepare the statement
// Notice that we avoid using "SELECT *" here. This is considered
// good practice so we don't inadvertently bring back data we don't
// want, especially if the database changes later.
//$statement = $db->prepare("SELECT name FROM recipe");
//$statement->execute();
// Go through each result
$rows = null;

if(!empty($_POST['name'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $likeName = '%' . $name . '%';

    $stmt = $db->prepare('SELECT * FROM public.recipes WHERE name LIKE :name');
    $stmt->bindValue('name', $likeName, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

else {
    $stmt = $db->prepare('SELECT * FROM public.recipe');
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

foreach($rows as $row) {
    echo '<p>';
    echo '<a href="recipeDetails.php?id=' . $row['name'] . '">' . '</a>';
    echo '</p>';
}
?>

        <br>
        <form action="index.php" class="search" method="post">
            <strong><label for="name">Name:</label></strong>
            <input type="text" name="name" id="name">
            <input type="submit" value="Search">
        </form>

    </body>
</html>