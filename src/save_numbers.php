<?php
include ('local.config.php');
try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
} catch (Exception $exception) {
    die('DB connection failed');
}

$sql = 'INSERT INTO numbers (date, n1, n2, n3, n4, n5, n6) VALUES ';

if (($handle = fopen("lottery_numbers.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 2000)) !== FALSE) {
        $date = DateTime::createFromFormat(
            'Y M d',
            $data[4].' '.$data[3].' '.$data[2]
        );
        $sql .= '("' . $date->format('Y-m-d') . '", ' 
            . $data[5] . ', ' 
            . $data[6] . ', ' 
            . $data[7] . ', '
            . $data[8] . ', '
            . $data[9] . ', '
            . $data[10] . '), ';
    }
    fclose($handle);
    $sql = substr($sql, 0, strlen($sql)-2) . ';';
    if (!$dbh->query($sql)) {
        print_r($dbh->errorInfo());
    }
}
