<?php
include('local.config.php');

$numbers = array_flip(range(1,49));
array_walk($numbers, function(&$value) { $value = 0; });

$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

$result = $dbh->query('SELECT * FROM numbers ORDER BY date ASC;');

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $numbers[(int)$row['n1']]++;
    $numbers[(int)$row['n2']]++;
    $numbers[(int)$row['n3']]++;
    $numbers[(int)$row['n4']]++;
    $numbers[(int)$row['n5']]++;
    $numbers[(int)$row['n6']]++;
}

asort($numbers);
print_r($numbers);

