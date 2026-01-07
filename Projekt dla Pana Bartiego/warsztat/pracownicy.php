<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACOWNICY</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <nav>
    <p><a href="warsztat.php">Strona główna</a></p>
    <p><a href="klienci.php">Klienci</a></p>
    <p><a href="pojazdy.php">Pojazdy</a></p>
    </nav>


<?php
require_once('db_conn.php');

$q = '';
if (isset($_GET['q'])) {
    $q = $_GET['q'];
}

echo '<form method="GET" action="pracownicy.php">
        <input type="text" name="q" placeholder="Szukaj pracownika..." value="'.$q.'">
        <button type="submit">Szukaj</button>
      </form>';

echo "<a class='dodaj' href='pracownicy_create.php'>DODAJ</a>";
echo "<a class='dodaj' href='pracownicy_export_csv.php'>POBIERZ CSV</a>";

$sql_count = "SELECT COUNT(*) as total FROM pracownicy";
$result_count = mysqli_query($conn, $sql_count);
$total_clients = 0;
if ($row = mysqli_fetch_assoc($result_count)) {
    $total_clients = $row['total'];
}
echo "<p>Łączna liczba klientów: <strong>$total_clients</strong></p>";

$sql_all = 'SELECT * FROM pracownicy';
$result_all = mysqli_query($conn, $sql_all);

if(mysqli_num_rows($result_all) > 0){
    echo "<h2>Wszyscy pracownicy</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Pensja</th>
            <th>Nr telefonu</th>
            <th>Usuń</th>
            <th>Edytuj</th>
          </tr>";
    while($row = mysqli_fetch_assoc($result_all)){
        echo "<tr>";
        echo "<td>".$row['id_pracownika']."</td>";
        echo "<td>".$row['Imie']."</td>";
        echo "<td>".$row['Nazwisko']."</td>";
        echo "<td>".$row['Pensja']."</td>";
        echo "<td>".$row['Nr_telefonu']."</td>";
        echo "<td><a href='pracownicy_delete.php?id=".$row['id_pracownika']."'>DELETE</a></td>";
        echo "<td><a href='pracownicy_update.php?id=".$row['id_pracownika']."'>UPDATE</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Brak pobranych rekordów!";
}

if ($q != '') {
    $sql_search = "SELECT * FROM pracownicy 
                   WHERE Imie LIKE '%$q%' 
                      OR Nazwisko LIKE '%$q%' 
                      OR Pensja LIKE '%$q%'
                      OR Nr_telefonu = '%$q%'";
    $result_search = mysqli_query($conn, $sql_search);
    $search_count = mysqli_num_rows($result_search);

    echo "<p>Liczba wyników wyszukiwania dla '$q': <strong>$search_count</strong></p>";
}

if ($q != '') {
    $sql_search = "SELECT * FROM pracownicy 
                   WHERE Imie LIKE '%$q%' 
                      OR Nazwisko LIKE '%$q%' 
                      OR Pensja LIKE '%$q%'
                      OR Nr_telefonu = '%$q%'";

    $result_search = mysqli_query($conn, $sql_search);

    if(mysqli_num_rows($result_search) > 0){
        echo "<h2>Wyniki wyszukiwania dla: $q</h2>";
        echo "<table border='1'>";
        echo "<tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Pensja</th>
            <th>Nr telefonu</th>
            <th>Usuń</th>
            <th>Edytuj</th>
              </tr>";
        while($row = mysqli_fetch_assoc($result_search)){
            echo "<tr>";
        echo "<td>".$row['id_pracownika']."</td>";
        echo "<td>".$row['Imie']."</td>";
        echo "<td>".$row['Nazwisko']."</td>";
        echo "<td>".$row['Pensja']."</td>";
        echo "<td>".$row['Nr_telefonu']."</td>";
        echo "<td><a href='pracownicy_delete.php?id=".$row['id_pracownika']."'>DELETE</a></td>";
        echo "<td><a href='pracownicy_update.php?id=".$row['id_pracownika']."'>UPDATE</a></td>";
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