<?php
require_once('db_conn.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=klienci.csv');

$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'Imię', 'Nazwisko', 'Pesel', 'Nr telefonu']);

$sql = "SELECT * FROM klienci";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['id_klienta'],
        $row['Imie'],
        $row['Nazwisko'],
        $row['Pesel'],
        $row['Nr_telefonu']
    ]);
}

fclose($output);
exit();
?>
