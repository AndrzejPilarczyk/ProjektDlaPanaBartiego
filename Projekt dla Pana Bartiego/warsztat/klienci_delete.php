<?php
require_once('db_conn.php');

$id = (int)$_GET['id'];

$check = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS ile FROM pojazdy WHERE id_klienta = $id"
);

$row = mysqli_fetch_assoc($check);

if ($row['ile'] > 0) {
    echo "Nie można usunąć klienta – najpierw usuń jego pojazdy!";
    exit;
}

$sql = "DELETE FROM klienci WHERE id_klienta = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: klienci.php");
    exit;
} else {
    echo "Błąd przy usuwaniu! " . mysqli_error($conn);
}
