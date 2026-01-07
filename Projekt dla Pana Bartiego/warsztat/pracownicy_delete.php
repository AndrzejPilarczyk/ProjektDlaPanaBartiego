<?php
require_once('db_conn.php');

$id = (int)$_GET['id'];


$sql = "DELETE FROM pracownicy WHERE id_pracownika = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: pracownicy.php");
    exit;
} else {
    echo "Błąd przy usuwaniu! " . mysqli_error($conn);
}
