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

try{ 
$db->beginTransaction();  

//insert data into recipe table
  if (isset($_POST['name']) && isset($_POST['instructions'])) {
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $instructions  = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_STRING);
  $lines = explode("\r\n", $instructions);
  $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

  $stmt = $db->prepare('INSERT INTO recipe (name, instructions, category) VALUES (:name, :instructions, :category) ON CONFLICT (name) DO UPDATE SET name = recipe.name RETURNING id;');

  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':instructions', json_encode($lines));
  $stmt->bindValue(':category', $category);
  $stmt->execute();

  //get recipe ID
  $result = $stmt->fetch();
  $recipe_id = $result['id'];
}

//insert data into ingredients table 
if (isset($_POST['qty']) && isset($_POST['unit']) && isset($_POST['ingredient'])) {

  $quantities  = filter_input(INPUT_POST, 'qty', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  $units       = filter_input(INPUT_POST, 'unit',FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  $ingredients = filter_input(INPUT_POST, 'ingredient', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  
  $insertData = array();

  for ($i = 0; $i < count($quantities); $i++) {
    array_push($insertData, array(
    'qty'        => $quantities[$i],
    'unit'       => $units[$i],
    'ingredient' => $ingredients[$i]  
  ));
  }

  $stmt = $db->prepare('INSERT INTO ingredients (description) VALUES (:insertData) RETURNING id;');

  $stmt->bindValue(':insertData', json_encode($insertData));
  $stmt->execute();

//get ingredients ID 
  $iResult = $stmt->fetch();
  $ingredients_id = $iResult['id'];
}

//insert data into recipe_ingredients table 
  if (isset($recipe_id) && isset($ingredients_id)){

  $stmt = $db->prepare('INSERT INTO recipe_ingredients (recipe_id, ingredients_id) VALUES (:recipe_id, :ingredients_id);');
  
  $stmt->bindValue('recipe_id', $recipe_id);
  $stmt->bindValue('ingredients_id', $ingredients_id);
  $stmt->execute();  
}

    $db->commit();
  } 
  //catch (\PDOException $e) {
  catch (Exception $e) {
    $db->rollBack();
    echo $e;
  }     

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