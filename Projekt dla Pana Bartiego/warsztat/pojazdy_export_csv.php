<?php
require_once('db_conn.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=pojazdy.csv');

$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'Nr rej', 'Marka', 'Model', 'Typ silnika, Pracownik, Data przyjazdu, Data odjazdu, id klienta']);

$sql = "SELECT * FROM pojazdy";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['id_pojazdu'],
        $row['Nr_rejestracyjny'],
        $row['Marka'],
        $row['Model'],
        $row['Typ_Silnika'],
        $row['Pracownik'],
        $row['Data_przyjazdu'],
        $row['Data_odjazdu'],
        $row['id_klienta']
    ]);
}

fclose($output);
exit();
?>
