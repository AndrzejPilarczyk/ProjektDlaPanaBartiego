<?php

require_once('db_conn.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM pojazdy WHERE id_pojazdu='$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $nr_rej = $_POST['nr_rej'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $typ_silnika = $_POST['typ_silnika'];
    $pracownik = $_POST['pracownik'];
    $aktualny_przebieg = $_POST['aktualny_pzebieg'];
    $data_przyjazdu = $_POST['data_przyjazdu'];
    $data_odjazdu = $_POST['data_odjazdu'];
    $id_klienta = $_POST['id_klienta'];

    if ($nr_rej === '') $errors[] = "Nr rejestracyjny jest wymagany!";
    if ($marka === '') $errors[] = "Marka jest wymagana!";
    if ($model === '') $errors[] = "Model jest wymagany!";
    if ($typ_silnika === '') $errors[] = "Typ silnika jest wymagany!";
    if ($pracownik === '') $errors[] = "Pracownik musi być wybrany!";
    if ($aktualny_przebieg === '' || !is_numeric($aktualny_przebieg)) $errors[] = "Aktualny przebieg musi być liczbą!";
    if ($data_przyjazdu === '') $errors[] = "Data przyjazdu jest wymagana!";
    if ($data_odjazdu === '') $errors[] = "Data odjazdu jest wymagana!";
    if ($data_przyjazdu > $data_odjazdu) $errors[] = "Data przyjazdu nie może być późniejsza niż data odjazdu!";

    $sql = "UPDATE pojazdy SET Nr_rejestracyjny='$nr_rej', Marka='$marka', Model='$model', Typ_Silnika='$typ_silnika', Pracownik='$pracownik', Aktualny_pzebieg='$aktualny_przebieg', Data_przyjazdu='$data_przyjazdu', Data_odjazdu='$data_odjazdu', id_klienta='$id_klienta' WHERE id_pojazdu='$id'";

    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, "SELECT * FROM pojazdy WHERE id_pojazdu='$id'");
        $user = mysqli_fetch_assoc($result);
        echo "Dane zaktualizowane!";
    } else {
        echo "Błąd aktualizacji: " . mysqli_error($conn);
    }

    if(isset($_POST['wroc'])){
    header("Location: pojazdy.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAAKTUALIZUJ POJAZD</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <h1>UPDATE</h1>

    <?php if(!empty($user)): ?>

        <form method="POST">

        <input type="hidden" name="id" value="<?= $user['id_pojazdu']?>"><br>

        <label>Nr rejestracyjny</label>
        <input type="text" name="nr_rej" value="<?= $user['Nr_rejestracyjny']?>"><br>

        <label>Marka</label>
        <input type="text" name="marka" value="<?= $user['Marka']?>"><br>

        <label>Model</label>
        <input type="text" name="model" value="<?= $user['Model']?>"><br>

        <label>Typ silnika</label>
        <input type="text" name="typ_silnika" value="<?= $user['Typ_Silnika']?>"><br>

        <label>Pracownik</label>
        <input type="text" name="pracownik" value="<?= $user['Pracownik']?>"><br>

        <label>Aktualny przebieg</label>
        <input type="text" name="aktualny_pzebieg" value="<?= $user['Aktualny_pzebieg']?>"><br>

        <label>Data przyjazdu</label>
        <input type="text" name="data_przyjazdu" value="<?= $user['Data_przyjazdu']?>"><br>

        <label>Data odjazdu</label>
        <input type="text" name="data_odjazdu" value="<?= $user['Data_odjazdu']?>"><br>

        <label>Id klienta</label>
        <input type="text" name="id_klienta" value="<?= $user['id_klienta']?>"><br>

        <button type="submit">UPDATE</button>
        <button type="submit" name="wroc">WRÓĆ</button>

        </form>

        <?php else: ?>
            <p>Nie znaleziono usera!</p>
        
        <?php endif; ?>
</body>
</html>