<?php
require_once('db_conn.php');

$sql = "SELECT * FROM klienci WHERE Imie LIKE '%$q%' OR Nazwisko LIKE '%$q%' OR Pesel LIKE '%$q%' OR Nr_telefonu LIKE '%$q%'";

$result = mysqli_query($conn, $sql);
?>
