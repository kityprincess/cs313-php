<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Stowe TOA Week 03 PHP</title>
</head>
<body>
	Name: <?php echo $_POST["name"]; ?><br>
	Email: <?php echo "mailto:".$_POST["email"]; ?><br> 
	/* need javascript to convert addy to mailto:? https://www.webdeveloper.com/forum/d/185032-how-to-convert-text-input-into-hyperlink */
	Major: <?php echo $_POST["major"]; ?><br>
	Comments: <?php echo $_POST["comments"]; ?><br>
</body>
</html>