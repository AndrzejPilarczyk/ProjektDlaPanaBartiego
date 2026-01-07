<?php
require_once('db_conn.php');

$sql = "SELECT * FROM pojazdy WHERE Nr_rejestracyjny LIKE '%$q%' OR Marka LIKE '%$q%' OR Model LIKE '%$q%' OR Typ_Silnika LIKE '%$q%' OR Pracownik LIKE '%$q%' OR Data_przyjazdu LIKE '%$q%' OR Data_odjazdu LIKE '%$q%' OR id_klienta LIKE '%$q%'";

$result = mysqli_query($conn, $sql);
?>
