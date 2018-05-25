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
    $scripture_id = $_GET['id'];

    $stmt = $db->prepare('SELECT * FROM scriptures.scriptures WHERE scripture_id = :scripture_id');
    $stmt->bindValue(':scripture_id', $scripture_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h1>Scripture Details</h1>';

    foreach($rows as $row) {
        echo '<p>';
        echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong>';
        echo '</p>';
        echo '<p>';
        echo $row['content'];
        echo '</p>';
    }
}

else {
    echo '<a href="index.php">Scripture not found!</a>';
}

