<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
    <title>Heirloom Recipes</title>
  </head>
  <body>
    <h2><a href="index.php">Discover more recipes!</a></h2>
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

if(!empty($_GET['id'])){
    $id = $_GET['id'];

	$stmt = $db->prepare('DELETE FROM recipe_ingredients WHERE recipe_id = :id;');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    echo 'Recipe deleted!'
  } 
  catch (Exception $e) {
    $db->rollBack();
    echo $e;
  }

?>
  </body>
</html>