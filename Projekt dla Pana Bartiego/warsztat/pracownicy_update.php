<?php

require_once('db_conn.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM pracownicy WHERE id_pracownika='$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $pensja = $_POST['pensja'];
    $nr_tel = $_POST['nr_tel'];

    if ($imie === '') $errors[] = "Imię jest wymagane!";
    if ($nazwisko === '') $errors[] = "Nazwisko jest wymagane!";
    if ($pensja === '' || !is_numeric($pensja) || $pensja < 0) $errors[] = "Pensja musi być liczbą większą lub równą 0!";
    if ($nr_tel === '') $errors[] = "Numer telefonu musi być cyframi (9–15 znaków)!";

    $sql = "UPDATE pracownicy SET Imie='$imie', Nazwisko='$nazwisko', Pensja='$pensja', Nr_telefonu='$nr_tel' WHERE id_pracownika='$id'";

    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, "SELECT * FROM pracownicy WHERE id_pracownika='$id'");
        $user = mysqli_fetch_assoc($result);
        echo "Dane zaktualizowane!";
    } else {
        echo "Błąd aktualizacji: " . mysqli_error($conn);
    }

    if(isset($_POST['wroc'])){
    header("Location: pracownicy.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAAKTUALIZUJ PRACOWNIKA</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <h1>ZAAKTUALIZUJ PRACOWNIKA</h1>

    <?php if(!empty($user)): ?>

        <form method="POST">

        <input type="hidden" name="id" value="<?= $user['id_pracownika']?>"><br>

        <label>Imie</label>
        <input type="text" name="imie" value="<?= $user['Imie']?>"><br>

        <label>Nazwisko</label>
        <input type="text" name="nazwisko" value="<?= $user['Nazwisko']?>"><br>

        <label>Pensja</label>
        <input type="text" name="pensja" value="<?= $user['Pensja']?>"><br>

        <label>Numer telefonu</label>
        <input type="text" name="nr_tel" value="<?= $user['Nr_telefonu']?>"><br>

        <button type="submit">UPDATE</button>
        <button type="submit" name="wroc">WRÓĆ</button>

        </form>

        <?php else: ?>
            <p>Nie znaleziono usera!</p>
        
        <?php endif; ?>
</body>
</html>