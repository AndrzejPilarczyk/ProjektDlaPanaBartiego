<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DODAWANIE KLIENTA</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <h1>NOWY KILENT</h1>

        <form method="POST" class="klient-form">

        <label>Imie</label>
        <input type="text" class="imie" name="imie" required>

        <label>Nazwisko</label>
        <input type="text" class="nazwisko" name="nazwisko" required>

        <label>Pesel</label>
        <input type="number" class="pesel" name="pesel" required>

        <label>Nr Telefonu</label>
        <input type="number" class="nr_tel" name="nr_tel" required>

        <button type="submit">DODAJ KLIENTA</button>

        </form>

<?php

require_once('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imie = $_POST['imie']; 
    $nazwisko = $_POST['nazwisko'];
    $pesel = $_POST['pesel'];
    $nr_tel = $_POST['nr_tel'];

    if ($imie === '') $errors[] = "Imię jest wymagane!";
    if ($nazwisko === '') $errors[] = "Nazwisko jest wymagane!";
    if ($pesel === '') $errors[] = "PESEL musi mieć 11 cyfr!";
    if ($nr_tel === '') $errors[] = "Numer telefonu musi być cyframi (9–15 znaków)!";

    $sql = "INSERT INTO klienci (Imie, Nazwisko, Pesel, Nr_telefonu)
            VALUES ('$imie', '$nazwisko', '$pesel', '$nr_tel')";

    if (mysqli_query($conn, $sql)) {
        echo "Rekord dodany!";
        header("Location: klienci.php");
        exit;
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
}

?>

</body>
</html>