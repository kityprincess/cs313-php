<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Stowe TOA Week 03 PHP</title>
</head>
<body>
	Name: <?php echo $_POST["name"]; ?><br>
	Email: <a href="<?php echo "mailto:".$_POST["email"]; ?>"><?php echo $_POST["email"]; ?></a><br> 
	Major: <?php echo $_POST["major"]; ?><br>
	Comments: <?php echo $_POST["comments"]; ?><br>
	Continents Visited: <?php echo $_POST["North_America"]; ?><br>
	<?php echo $_POST["South_America"]; ?><br>
	<?php echo $_POST["Europe"]; ?><br>
</body>
</html>