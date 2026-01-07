<?php
require_once('db_conn.php');

$id = (int)$_GET['id'];


$sql = "DELETE FROM pojazdy WHERE id_pojazdu = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: pojazdy.php");
    exit;
} else {
    echo "Błąd przy usuwaniu! " . mysqli_error($conn);
}
