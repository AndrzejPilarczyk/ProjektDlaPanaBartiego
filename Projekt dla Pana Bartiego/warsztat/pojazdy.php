<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POJAZDY</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <nav>
    <p><a href="warsztat.php">Strona główna</a></p>
    <p><a href="klienci.php">Klienci</a></p>
    <p><a href="pracownicy.php">Pracownicy</a></p>
    </nav>


<?php
require_once('db_conn.php');

$q = '';
if (isset($_GET['q'])) {
    $q = $_GET['q'];
}

echo '<form method="GET" action="pojazdy.php">
        <input type="text" name="q" placeholder="Szukaj pojazdu..." value="'.$q.'">
        <button type="submit">Szukaj</button>
      </form>';

echo "<a class='dodaj' href='pojazdy_create.php'>DODAJ</a>";
echo "<a class='dodaj' href='pojazdy_export_csv.php'>POBIERZ CSV</a>";

$sql_count = "SELECT COUNT(*) as total FROM pojazdy";
$result_count = mysqli_query($conn, $sql_count);
$total_clients = 0;
if ($row = mysqli_fetch_assoc($result_count)) {
    $total_clients = $row['total'];
}
echo "<p>Łączna liczba klientów: <strong>$total_clients</strong></p>";

$sql_all = 'SELECT * FROM pojazdy';
$result_all = mysqli_query($conn, $sql_all);

if(mysqli_num_rows($result_all) > 0){
    echo "<h2>Wszystkie pojazdy</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Nr_rejestracyjny</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Typ Silnika</th>
            <th>Pracownik</th>
            <th>Aktualny przebieg</th>
            <th>Data przyjazdu</th>
            <th>Data odjazdu</th>
            <th>ID klienta</th>
            <th>Usuń</th>
            <th>Edytuj</th>
          </tr>";
    while($row = mysqli_fetch_assoc($result_all)){
        echo "<tr>";
        echo "<td>".$row['id_pojazdu']."</td>";
        echo "<td>".$row['Nr_rejestracyjny']."</td>";
        echo "<td>".$row['Marka']."</td>";
        echo "<td>".$row['Model']."</td>";
        echo "<td>".$row['Typ_Silnika']."</td>";
        echo "<td>".$row['Pracownik']."</td>";
        echo "<td>".$row['Aktualny_pzebieg']."</td>";
        echo "<td>".$row['Data_przyjazdu']."</td>";
        echo "<td>".$row['Data_odjazdu']."</td>";
        echo "<td>".$row['id_klienta']."</td>";
        echo "<td><a href='pojazdy_delete.php?id=".$row['id_pojazdu']."'>DELETE</a></td>";
        echo "<td><a href='pojazdy_update.php?id=".$row['id_pojazdu']."'>UPDATE</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Brak pobranych rekordów!";
}

if ($q != '') {
    $sql_search = "SELECT * FROM pojazdy 
                   WHERE Nr_rejestracyjny LIKE '%$q%' 
                      OR Marka LIKE '%$q%' 
                      OR Model LIKE '%$q%'
                      OR Typ_Silnika LIKE '%$q%'
                      OR Pracownik LIKE '%$q%'
                      OR Data_przyjazdu LIKE '%$q%'
                      OR Data_odjazdu LIKE '%$q%'
                      OR id_klienta LIKE '%$q%'"; 
    $result_search = mysqli_query($conn, $sql_search);
    $search_count = mysqli_num_rows($result_search);

    echo "<p>Liczba wyników wyszukiwania dla '$q': <strong>$search_count</strong></p>";
}

if ($q != '') {
    $sql_search = "SELECT * FROM pojazdy 
                   WHERE Nr_rejestracyjny LIKE '%$q%' 
                      OR Marka LIKE '%$q%' 
                      OR Model LIKE '%$q%'
                      OR Typ_Silnika LIKE '%$q%'
                      OR Pracownik LIKE '%$q%'
                      OR Data_przyjazdu LIKE '%$q%'
                      OR Data_odjazdu LIKE '%$q%'
                      OR id_klienta LIKE '%$q%'";
    $result_search = mysqli_query($conn, $sql_search);

    if(mysqli_num_rows($result_search) > 0){
        echo "<h2>Wyniki wyszukiwania dla: $q</h2>";
        echo "<table border='1'>";
        echo "<tr>
            <th>ID</th>
            <th>Nr_rejestracyjny</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Typ Silnika</th>
            <th>Pracownik</th>
            <th>Aktualny przebieg</th>
            <th>Data przyjazdu</th>
            <th>Data odjazdu</th>
            <th>ID klienta</th>
            <th>Usuń</th>
            <th>Edytuj</th>
              </tr>";
        while($row = mysqli_fetch_assoc($result_search)){
            echo "<tr>";
        echo "<td>".$row['id_pojazdu']."</td>";
        echo "<td>".$row['Nr_rejestracyjny']."</td>";
        echo "<td>".$row['Marka']."</td>";
        echo "<td>".$row['Model']."</td>";
        echo "<td>".$row['Typ_Silnika']."</td>";
        echo "<td>".$row['Pracownik']."</td>";
        echo "<td>".$row['Aktualny_pzebieg']."</td>";
        echo "<td>".$row['Data_przyjazdu']."</td>";
        echo "<td>".$row['Data_odjazdu']."</td>";
        echo "<td>".$row['id_klienta']."</td>";
        echo "<td><a href='pojazdy_delete.php?id=".$row['id_pojazdu']."'>DELETE</a></td>";
        echo "<td><a href='pojazdy_update.php?id=".$row['id_pojazdu']."'>UPDATE</a></td>";
        echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Brak wyników dla $q";
    }
}
?>


</body>
</html>