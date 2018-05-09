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
	Continents Visited:<br> 
	<?php $continents = array();
        if(!empty($_POST["continent"])) {
        foreach($_POST["continent"] as $continent) {
            array_push($continents, htmlspecialchars($continent));
            }
        }
        else {
            array_push($continents, "none");
        } ?>
    <?php
        // Stretch #2
        $continent_codes = array("na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antarctica", "none" => "You've been on an island your whole life!");
        foreach($continents as $continent)
            echo "<p>" . $continent_codes[$continent] . "</p>";
    ?>


	<?php /*<?php echo $_POST["North_America"]; ?><br>
	<?php echo $_POST["South_America"]; ?><br>
	<?php echo $_POST["Europe"]; ?><br>
	<?php echo $_POST["Asia"]; ?><br>
	<?php echo $_POST["Australia"]; ?><br>
	<?php echo $_POST["Africa"]; ?><br>
	<?php echo $_POST["Antarctica"]; ?><br> */?>
</body>
</html>