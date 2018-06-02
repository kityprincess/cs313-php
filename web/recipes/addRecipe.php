<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
    <script type="text/javascript" src="addRecipe.js"></script> 
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

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

do{ 
  $db->beginTransaction();

  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $instructions  = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_STRING);
  $lines = explode("\r\n", $instructions);
  $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);


  $stmt = $db->prepare('INSERT INTO recipe (name, instructions, category) VALUES (:name, :instructions, :category) ON CONFLICT (name) DO UPDATE SET name = recipe.name RETURNING id;');
  $stmt->bindValue('name', $name);
  $stmt->bindValue('instructions', json_encode($lines));
  $stmt->bindValue('category', $category);
  $stmt->execute();

  $result = $stmt->fetch();
  $recipe_id = $result['id'];

  $quantities  = filter_input(INPUT_POST, 'quantity',   FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  $ingredients = filter_input(INPUT_POST, 'ingredient', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  $units       = filter_input(INPUT_POST, 'unit',       FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  
  $insertData = array();

  for ($i = 0; $i < count($quantities); $i++) {
    array_push($insertData, array(
    'ingredient' => $ingredients[$i],
    'unit'       => $units[$i],
    'quantity'   => $quantities[$i]
  ));
  }

  $ingLines = explode("\r\n", $insertData);

  $stmt = $db->prepare('INSERT INTO ingredients (recipe_id, description) VALUES (:recipe_id, :insertData) RETURNING id;')

  $stmt->bindValue('recipe_id', $recipe_id);
  $stmt->bindValue('desription', json_encode($ingLines));
  $stmt->execute();

  echo '<pre>';
  var_dump($insertData);
  echo '</pre>';

    /* $ingredient = filter_input(INPUT_POST, 'ingredient', FILTER_SANITIZE_STRING);
       $data[] = array(ingredient)
    

    $ingredient = filter_input(INPUT_POST, 'ingredient', FILTER_SANITIZE_STRING);
    $stmt = $db->prepare('INSERT INTO ingredients (recipe_id, name) VALUES (:recipe_id, :ingredient) RETURING id;')

    foreach ($ingredient as $ingredient) {
      $stmt->bindValue('recipe_id', $recipe_id);
      $stmt->bindValue('ingredient', $ingredient)  
      $stmt->execute();

      $result = $stmt->fetch();
      $ingredient_id = $result['id'];
    }
    */

    $db->commit();
  } 
  catch (\PDOException $e) {
    $db->rollBack();
    throw $e;
  }     

/*  if (isset($_POST['']))
  ('INSERT INTO ingredients (recipe_id, name) VALUES (:recipe_id, :ingredient)')
  $stmt->bindValue('recipe_ip', $recipe_id);*/

  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
?>

<div class = "table">
<form action="addRecipe.php" method="post">
  <h1>Add your recipe - Is this on?</h1>
  <fieldset class="row1">
    <label for="name">Name:</label>
    <input type="text" name="name" required="required" id="name">
    <label for="category">Category:</label>
    <input type="text" name="category" id="category">
  </fieldset>
  <fieldset class="row2">
    <legend>Ingredients</legend>
    <input type="button" value="Add Ingredient" onClick="addRow('ingTable')" />
    <input type="button" value="Remove Ingredient" onClick="deleteRow('ingTable')" />    
    <table id="ingTable" class="form" border="1">
      <tbody>
        <tr>
          <td><input type="checkbox" required="required" name="chk[]" checked="checked" />
          </td>
          <td><input type="number" min="0" name="qty[]" required="required" id="qty" placeholder="Quantity">
          </td>
          <td><input type="text" name="unit[]" required="required" id="unit" placeholder="Unit">
          </td>
          <td><input type="text" name="ingredient[]" required="required" id="ingredient" placeholder="Ingredient">
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>
  <fieldset class="row3">
    <legend>Instructions</legend>
    <label for="Instructions">Put each step on its own line</label>
    <textarea name="instructions" required="required"></textarea>
  </fieldset>
  <input class="submit" type="submit" value="Add new recipe"/>
</form>
</div>

<?php
$stmt = $db->query('SELECT * FROM recipe');

while ($row = $stmt->fetch()) {
  echo '<ul>';

  $instructions = json_decode($row['instructions']);

  foreach ($instructions as $part) {
    echo '<li>' . $part . '</li>';
  }

  echo '</ul>';
}

/*
http://www.postgresqltutorial.com/postgresql-php/transaction/
*/
?>
  </body>
</html>