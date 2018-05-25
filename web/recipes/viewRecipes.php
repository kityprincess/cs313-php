<?php
/**********************************************************
* File: viewRecipes.php
* Author: Kimberly Stowe, based off Br. Burton's
*         viewScriptures file
* 
* Description: Queries PostgreSQL database from PHP.
***********************************************************/
require "dbConnect.php";
$db = get_db();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Recipes</title>
</head>

<body>
<div>

<h1>Recipes</h1>

<?php
// In this example, for simplicity, the query is executed
// right here and the data echoed out as we iterate the query.
// You could imagine that in a more involved application, we
// would likely query the database in a completely separate file / function
// and build a list of objects that held the components of each
// scripture. Then, here on the page, we could simply call that 
// function, and iterate through the list that was returned and
// print each component.
// First, prepare the statement
// Notice that we avoid using "SELECT *" here. This is considered
// good practice so we don't inadvertently bring back data we don't
// want, especially if the database changes later.
$statement = $db->prepare("SELECT name FROM recipe");
$statement->execute();
// Go through each result
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	// The variable "row" now holds the complete record for that
	// row, and we can access the different values based on their
	// name
	echo '<p>';
	echo '<strong>' . $row['name'] . '</strong>';
	echo '</p>';
}
?>


</div>

</body>
</html>