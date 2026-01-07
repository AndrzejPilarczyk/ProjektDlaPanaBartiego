<?php
require_once('db_conn.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=pracownicy.csv');

$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'Imię', 'Nazwisko', 'Pensja', 'Nr telefonu']);

$sql = "SELECT * FROM pracownicy";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['id_pracownika'],
        $row['Imie'],
        $row['Nazwisko'],
        $row['Pensja'],
        $row['Nr_telefonu']
    ]);
}

fclose($output);
exit();
?>
