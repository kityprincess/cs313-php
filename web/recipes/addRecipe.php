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

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  <form action="addRecipes.php" method="post">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name">
      <input type="submit" value="Search">
  </form>

if (isset($_POST['instructions'])) {
  $instructions  = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_STRING);
  $lines = explode("\r\n", $instructions);

  $stmt = $db->prepare('INSERT INTO recipe (instructions) VALUES (:instructions);');
  $stmt->bindValue('instructions', json_encode($lines));
  $stmt->execute();
}
?>

<form action="addRecipe.php" method="post">
  <textarea name="instructions"></textarea>
  <button>Submit</button>
</form>

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
CREATE TABLE testing (
  id SERIAL PRIMARY KEY,
  data JSONB NOT NULL
);
*/
?>

    </body>
</html>