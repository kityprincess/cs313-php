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
        FROM
         recipe r
        WHERE
         r.id = :id', $id);

        $recipeInfo['ingredient'] = doOneQuery($db,
        'SELECT
         r.id
        ,i.name
        ,ri.qty
        ,u.description
        ,u.abbr
        FROM
         recipe r
          INNER JOIN
         recipe_ingredients ri ON r.id = ri.recipe_id
          INNER JOIN
         ingredients i ON i.id = ri.ingredients_id
          INNER JOIN
         units u ON u.id = ri.unit_id
        WHERE
         r.id = :id', $id);

        $recipeInfo['category'] = doOneQuery($db,
        'SELECT
         r.id
        ,c.description
        FROM
         recipe r
          INNER JOIN
         recipe_category rc ON rc.recipe_id = r.id
          INNER JOIN
         category c ON c.id = rc.category_id
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

    echo '<pre>';
    print_r ($rDetails);
    echo '</pre>';

    echo '<h1>';
    echo $rDetails['recipe'][0]['name'];
    echo '</h1>';

    echo '<p>';
    foreach ($rDetails['ingredient'] AS $ing) 
    {
        
        echo $ing[0]['qty'] . ' ' . $ing[0]['abbr'] . ' ' . $ing[0]['name'];
        echo '<br/>';
    }

    foreach($rDetails[category] AS $cat)
    {
        echo $cat['c.description'];
        echo '<br/>';
    }

        foreach($rDetails[media] AS $med)
    {
        echo $med['m.file'];
        echo '<br/>';
    }

    echo '</p>';

    // echo '<h1>Recipe Details</h1>';

    // foreach($rows as $row) {
    //     echo '<p>';
    //     echo '<strong>' . $row['name'] . '</strong>';
    //     echo '</p>';
    //     echo '<p>';
    //     // need to echo through all ingredients
    //     echo $row['ingredients_id'];
    //     echo '<br/>';
    //     echo $row['instructions'];
    //     echo '</p>';
    // }
}

else {
    echo '<a href="index.php">Recipe not found!</a>';
}
?>

    </body>
</html>