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
  try{ 
      // echo "<pre>";
      // print_r($_POST);
      // echo "</pre>";

    $db->beginTransaction();  

    //delete from recipe
    $stmt = $db->prepare('DELETE FROM recipe WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    //delete from recipe_ingredients
    $stmt = $db->prepare('DELETE FROM recipe_ingredients WHERE recipe_id = :id RETURNING ingredients_id; ');
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    //get ingredients ID
    $result = $stmt->fetch();
    $ingredients_id = $result['ingredients_id'];

    //delete from ingredients
    $stmt = $db->prepare('DELETE FROM ingredients WHERE id = :ingredients_id; ');
    $stmt->bindValue(':ingredients_id', $ingredients_id);
    $stmt->execute();

    $db->commit();
    echo 'Recipe deleted!'
    } 
    catch (Exception $e) {
      $db->rollBack();
      echo $e;
    }
} 

?>
  </body>
</html>