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

        $recipeInfo['ingredients'] = doOneQuery($db,
        'SELECT
         r.id
        ,i.description
        FROM
          recipe r
            INNER JOIN
          recipe_ingredients ri ON r.id = ri.recipe_id
            INNER JOIN
          ingredients i ON i.id = ri.ingredients_id
        WHERE
         r.id = :id', $id);
        
        $recipeInfo['media']    = doOneQuery($db,
        'SELECT
         r.id
        ,m.description
        ,m.file
        FROM
         recipe r
          INNER JOIN
         media m ON m.recipe_id = r.id
        WHERE
         r.id = :id', $id);

        return $recipeInfo;
    }

    $rDetails = getRecipeInfo($db, $id);

    echo '<h1>';
    echo $rDetails['recipe'][0]['name'];
    echo '</h1>';
}

	try{ 
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";

	$db->beginTransaction();  
	$recipe_id = $_POST['recipe_id'];
	//update name
	  if (isset($_POST['name']) && ($_POST['name'] != '')) {
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

		$stmt = $db->prepare('UPDATE recipe SET name = :name WHERE id = :recipe_id;');

		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':recipe_id', $recipe_id);
		$stmt->execute();  
	}

		//update category
	  if (isset($_POST['category']) && ($_POST['category'] != '')) {
	  	$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
	  	echo $category;
	  	echo $id;
	  	$stmt = $db->prepare('UPDATE recipe SET category = :category WHERE id = :recipe_id;');

		  $stmt->bindValue(':category', $category);
		  $stmt->bindValue(':recipe_id', $recipe_id);
		  $stmt->execute();
	  }

	 //update instructions
	  if (isset($_POST['instructions']) && ($_POST['instructions'] != '')) {
	  	$instructions  = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_STRING);
	  $lines = explode("\r\n", $instructions);
	  
	  $stmt = $db->prepare('UPDATE recipe SET instructions = :instructions WHERE id = :recipe_id;');

	  $stmt->bindValue(':instructions', json_encode($lines));
	  $stmt->bindValue(':recipe_id', $recipe_id);
	  $stmt->execute();
	}

// //insert data into ingredients table 
// if (isset($_POST['qty']) && isset($_POST['unit']) && isset($_POST['ingredient'])) {

//   $quantities  = filter_input(INPUT_POST, 'qty', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
//   $units       = filter_input(INPUT_POST, 'unit',FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
//   $ingredients = filter_input(INPUT_POST, 'ingredient', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
  
//   $insertData = array();

//   for ($i = 0; $i < count($quantities); $i++) {
//     array_push($insertData, array(
//     'qty'        => $quantities[$i],
//     'unit'       => $units[$i],
//     'ingredient' => $ingredients[$i]  
//   ));
//   }
// //'UPDATE recipe SET instructions = :instructions WHERE id = :id;'
//   $stmt = $db->prepare('UPDATE ingredients description = :insertData RETURNING id;');

//   $stmt->bindValue(':insertData', json_encode($insertData));
//   $stmt->execute();

// //get ingredients ID 
//   $iResult = $stmt->fetch();
//   $ingredients_id = $iResult['id'];
// }

// //insert data into recipe_ingredients table 
//   if (isset($recipe_id) && isset($ingredients_id)){

//   $stmt = $db->prepare('INSERT INTO recipe_ingredients (recipe_id, ingredients_id) VALUES (:recipe_id, :ingredients_id);');
  
//   $stmt->bindValue('recipe_id', $recipe_id);
//   $stmt->bindValue('ingredients_id', $ingredients_id);
//   $stmt->execute();  
// }

    $db->commit();
  } 
  catch (Exception $e) {
    $db->rollBack();
    echo $e;
  }

?>
    <div class = "table">
      <form action="updateRecipe.php" method="post">
          <h3>Update your recipe</h3>
          <fieldset class="row1">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($rDetails['recipe'][0]['name']); ?>">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($rDetails['recipe'][0]['category']); ?>">
            <input type="hidden" name="recipe_id" id="recipe_id" value="<?php echo htmlspecialchars($id); ?>">
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
                  <td><input type="number" min="0" name="qty[]" id="qty" placeholder="Quantity">
                  </td>
                  <td><input type="text" name="unit[]" id="unit" placeholder="Unit">
                  </td>
                  <td><input type="text" name="ingredient[]" id="ingredient" placeholder="Ingredient">
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
          <input class="submit" type="submit" value="Update recipe"/>
      </form>
      <p><em>Note</em>: When updating the ingredients or instructions, you must include ALL ingredients or instructions. </p>
    </div>
  </body>
</html>