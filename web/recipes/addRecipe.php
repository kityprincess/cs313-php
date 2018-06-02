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

try {
  $db->beginTransaction();
    if (isset($_POST['name']) && isset($_POST['instructions'])) {
      $instructions  = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_STRING);
      $lines = explode("\r\n", $instructions);

       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

      $stmt = $db->prepare('INSERT INTO recipe (name, instructions) VALUES (:name, :instructions) RETURNING id;');
      $stmt->bindValue('name', $name);
       $stmt->bindValue('instructions', json_encode($lines));
       $stmt->execute();

      $result = $stmt->fetch();
     }
    $db->commit();
  } 
  catch (\PDOException $e) {
    $db->rollBack();
    throw $e;
  }     

/*try {
  $db->beginTransaction();
    if (isset($_POST['name']) && isset($_POST['instructions'])) {
    $instructions  = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_STRING);
    $lines = explode("\r\n", $instructions);

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    $stmt = $db->prepare('INSERT INTO recipe (name, instructions) VALUES (:name, :instructions) RETURNING id;');
    $stmt->bindValue('name', $name);
    $stmt->bindValue('instructions', json_encode($lines));
    $stmt->execute();

    /*$result = $stmt->fetch();
    $recipe_id = $result['id'];*/


/*  if (isset($_POST['']))
  ('INSERT INTO ingredients (recipe_id, name) VALUES (:recipe_id, :ingredient)')
  $stmt->bindValue('recipe_ip', $recipe_id);*/

  /*$db->commit();
  } catch (\PDOException $e) {
    $db->rollBack();
    throw $e;
  }*/

?>

<?php /*
<form action="addRecipe.php" method="post">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">

  <label for="Instructions">Instructions:<br/>Put each step on its own line</label>
  <textarea name="instructions"></textarea>

  <label for="Qty">Quantity</label>
  <button>Submit</button>
</form>*/

?>

<div class = "table">
<form action="addRecipe.php" method="post">
  <h1>Add your recipe</h1>
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
          <td><label for="qty">Qty:</label>
              <input type="number" step="any" min="0" name="qty" required="required" id="qty">
          </td>
          <td><label for="units">Units:</label>
              <input type="text" name="units" required="required" id="units">
          </td>
          <td><label for="ingredient">Ingredient:</label>
              <input type="text" name="ingredient" required="required" id="ingredient">
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>
  <fieldset class="row3">
    <legend>Instructions</legend>
    <label for="Instructions">Put each step on its own line</label>
    <textarea name="instructions"></textarea>
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

CREATE TABLE testing (
  id SERIAL PRIMARY KEY,
  data JSONB NOT NULL
);
*/
?>

    </body>
</html>