<?php
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

<?php

$rows = null;

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$likeName = '%' . $name . '%';

$stmt = $db->prepare('SELECT * FROM public.recipe WHERE LOWER(name) LIKE LOWER(:name)');
$stmt->bindValue(':name', $likeName, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {
    echo '<p>';
    echo '<a href="deletedRecipe.php?id=' . $row['id'] . '">' . $row['name'] . '</a>';
    echo '</p>';
}
?>
<p><a href="index.php">Go back home!</a></p>
    </body>
</html>