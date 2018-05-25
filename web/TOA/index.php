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

$rows = null;

if(!empty($_POST['book'])) {
    $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
    $likeBook = '%' . $book . '%';

    $stmt = $db->prepare('SELECT * FROM toa.scriptures WHERE book LIKE :book');
    $stmt->bindValue(':book', $likeBook, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

else {
    $stmt = $db->prepare('SELECT * FROM toa.scriptures');
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo '<h1>Scripture Resources</h1>';

foreach($rows as $row) {
    echo '<p>';
    echo '<a href="details.php?id=' . $row['scripture_id'] . '">';
    echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . ' - </strong></a>';
    echo '</p>';
}


?>
<!-- STRETCH CHALLENGE 01 -->

<br>
<form action="index.php" method="post">
    <strong><label for="book">Book:</label></strong>
    <input type="text" name="book" id="book">
    <input type="submit" value="Search">
</form>