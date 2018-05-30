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

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Heirloom Recipes</title>
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
</head>

<body id="main">
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

        <form action="index.php" class="search" method="post">
            <strong><label for="name">Name:</label></strong>
            <input type="text" name="search" id="name">
            <input type="submit" value="Search">
        </form>
<?php

$rows = null;

if(!empty($_POST['search'])) {
    $name = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
    $likeSearch = '%' . $search . '%';

    $stmt = $db->prepare('SELECT name FROM public.recipe WHERE name LIKE :search');
    $stmt->bindValue(':search', $likeSearch, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

else {
    $stmt = $db->prepare('SELECT name FROM public.recipe');
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

foreach($rows as $row) {
    echo '<p>';
    echo '<a href="recipeDetails.php?id=' . $row['id'] . '">' . $row['name'] . '</a>';
    echo '</p>';
}
?>
    </body>
</html>