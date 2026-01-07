<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DODAWANIE PRACOWNIKA</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <h1>NOWY PRACOWNIK</h1>

        <form method="POST">

        <label>Imie</label>
        <input type="text" name="imie"><br>

        <label>Nazwisko</label>
        <input type="text" name="nazwisko"><br>

        <label>Pensja</label>
        <input type="number" name="pensja"><br>

        <label>Nr Telefonu</label>
        <input type="number" name="nr_tel"><br>

        <button type="submit">DODAJ PRACOWNIKA</button>

        </form>

<?php

require_once('db_conn.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $pensja = $_POST['pensja'];
    $nr_tel = $_POST['nr_tel'];

    if ($imie === '') $errors[] = "Imię jest wymagane!";
    if ($nazwisko === '') $errors[] = "Nazwisko jest wymagane!";
    if ($pensja === '' || !is_numeric($pensja) || $pensja < 0) $errors[] = "Pensja musi być liczbą większą lub równą 0!";
    if ($nr_tel === '') $errors[] = "Numer telefonu musi być cyframi (9–15 znaków)!";

    $sql = "INSERT INTO pracownicy (Imie, Nazwisko, Pensja, Nr_telefonu)
            VALUES ('$imie', '$nazwisko', '$pensja', '$nr_tel')";

    if (mysqli_query($conn, $sql)) {
        echo "Rekord dodany!";
        header("Location: pracownicy.php");
        exit;
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
}

?>

</body>
</html>