<?php
require_once('db_conn.php');

$sql = "SELECT * FROM pracownicy WHERE Imie LIKE '%$q%' OR Nazwisko LIKE '%$q%' OR Pensja LIKE '%$q%' OR Nr_telefonu LIKE '%$q%'";

$result = mysqli_query($conn, $sql);
?>
