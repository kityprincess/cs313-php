<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
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

    echo '<p>';

    echo 'Ingredients:' . '<br/>';
    $jing = json_decode($rDetails['ingredients'][0]['description'], TRUE);
    echo '<ul>';
    foreach ($jing AS $ing) {
     echo '<li>' . $ing['qty'] . ' ' . $ing['unit'] . ' ' . $ing['ingredient'] . '</li>';
    }
    echo '</ul>';

    echo 'Instructions: ' . '<br/>';
    $jins = json_decode($rDetails['recipe'][0]['instructions'], TRUE);
    print_r($jins);
    echo '<ul>';
    foreach ($jins as $part) {
      echo '<li>' . $part . '</li>';
    }
    echo '</ul>';
    
    // echo '<ul>';
    // foreach ($jins AS $ins) {
    //   echo '<li>' . $ing . '</li>';
    //   }
    //   echo '</ul>';
    // }

    echo 'Category: ' . '<br/>';
    echo $rDetails['recipe'][0]['category'];

    // foreach ($rDetails['ingredients'] AS $ing) 
    // { 
    //     echo $ing['qty'] . ' ' . $ing['description'] . ' ' . $ing['name'];
    //     echo '<br/>';
    // }

    // echo '<br>';
    
    // echo 'Instructions:' . '<br/>';
    // echo $rDetails['recipe'][0]['instructions'];

    // echo '<br>' . '<br>';

    // foreach($rDetails['category'] AS $cat)
    // {
    //     echo 'Category: ';
    //     echo $cat['description'];
    //     echo '<br/>';
    // }

    foreach($rDetails['media'] AS $med)
    {
        echo $med['file'];
        echo '<br/>';
    }

    echo '<br/>';

    echo '<a href="index.php">Go back home!</a>';

    echo '</p>';
}

else {
    echo '<a href="index.php">Recipe not found!</a>';
}
?>

    </body>
</html>