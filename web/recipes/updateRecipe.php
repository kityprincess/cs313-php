<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
    <script type="text/javascript" src="addRecipe.js"></script> 
    <title>Heirloom Recipes</title>
  </head>
  <body>
    <h2><a href="addRecipe.php">Add a new recipe</a></h2>
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

	function doOneQuery($db, $query, $id)
	    {
	        $stmt = $db->prepare($query);
	        if ($stmt)
	        {
	            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
	            if ($stmt->execute())
	            {
	                return $stmt->fetchAll(PDO::FETCH_ASSOC);
	            }
	        }
	        return array();
	    }

    function getRecipeInfo($db, $id)
    {
        $recipeInfo['recipe']   = doOneQuery($db,
        'SELECT
         r.id
        ,r.name
        ,r.instructions
        ,r.category
        FROM
         recipe r
        WHERE
         r.id = :id', $id);

        // $recipeInfo['ingredients'] = doOneQuery($db,
        // 'SELECT
        //  r.id
        // ,i.description
        // FROM
        //   recipe r
        //     INNER JOIN
        //   recipe_ingredients ri ON r.id = ri.recipe_id
        //     INNER JOIN
        //   ingredients i ON i.id = ri.ingredients_id
        // WHERE
        //  r.id = :id', $id);
        
        // $recipeInfo['media']    = doOneQuery($db,
        // 'SELECT
        //  r.id
        // ,m.description
        // ,m.file
        // FROM
        //  recipe r
        //   INNER JOIN
        //  media m ON m.recipe_id = r.id
        // WHERE
        //  r.id = :id', $id);

        // return $recipeInfo;
    }

    $rDetails = getRecipeInfo($db, $id);

    echo '<h1>';
    echo $rDetails['recipe'][0]['name'];
    echo '</h1>';

    echo '<p>';

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

    //$row = $stmt->fetch();
    // echo 'Congratulations! Your recipe has been entered!';
    // echo '<a href="recipeDetails.php?id=' . $recipe_id . '">' . $recipe_id . '</a>';
  } 
  catch (Exception $e) {
    $db->rollBack();
    echo $e;
  }
}
?>

    <div class = "table">
      <form action="addRecipe.php" method="post">
          <h1>Update your recipe</h1>
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
  </body>
</html>