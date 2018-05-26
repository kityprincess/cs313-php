<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
    <title>Heirloom Recipes</title>
  </head>
  <body>
<?php

$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $stmt = $db->prepare('SELECT * FROM public.recipe WHERE id = :id');
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h1>Recipe Details</h1>';

    foreach($rows as $row) {
        echo '<p>';
        echo '<strong>' . $row['name'] . '</strong>';
        echo '</p>';
        echo '<p>';
        echo $row['instructions'];
        echo '</p>';
    }
}

else {
    echo '<a href="index.php">Recipe not found!</a>';
}
?>

    </body>
</html>