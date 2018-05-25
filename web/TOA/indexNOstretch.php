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

$stmt = $db->prepare('SELECT * FROM toa.scriptures');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<h1>Scripture Resources</h1>';

foreach($rows as $row) {
    echo '<p>';
    echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . ' - </strong>';
    echo '"' . $row['content'] . '"';
    echo '</p>';
}




