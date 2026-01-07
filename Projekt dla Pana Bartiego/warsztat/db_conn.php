<?php

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_SCHEMA = 'warsztat';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_SCHEMA);

if(!$conn){
    die("Błąd połączenia!") . mysqli_error($conn);
}

?>