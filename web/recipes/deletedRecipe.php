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
      echo "<pre>";
      print_r($_GET);
      echo "</pre>";
  
  // try{ 
  //   $db->beginTransaction();  

    //get ingredients_id
    $stmt = $db->prepare('SELECT ingredients_id FROM recipe_ingredients WHERE recipe_id = :id;');
    $stmt->bindValue(':id', $id,);
    $stmt->execute();
    $ingredients_id = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($ingredients_id);
    echo "</pre>";
  }  
    //delete from ingredients
    $stmt = $db->prepare('DELETE FROM ingredients WHERE id = :ingredients_id;');
    $stmt->bindValue(':ingredients_id', $ingredients_id);
    $stmt->execute();

    // //delete from recipe
    // $stmt = $db->prepare('DELETE FROM recipe WHERE id = :id');
    // $stmt->bindValue(':id', $id);
    // $stmt->execute();

    // //delete from recipe_ingredients
    // $stmt = $db->prepare('DELETE FROM recipe_ingredients WHERE recipe_id = :id; ');
    // $stmt->bindValue(':id', $id);
    // $stmt->execute();

    $db->commit();
    echo 'Recipe deleted!'
    } 
    catch (Exception $e) {
      $db->rollBack();
      echo $e;
      echo 'Danger, Will Robinson!'
    }
?>
  </body>
</html>