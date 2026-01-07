<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOWY POJAZD</title>
    <link rel="icon" href="Zrzut ekranu 2025-10-27 143450.png">
    <link rel="stylesheet" href="warsztat.css">
</head>
<body>
    <h1>NOWY POJAZD</h1>

<?php
require_once('db_conn.php');

$pracownicy_result = mysqli_query($conn, "SELECT id_pracownika, imie, nazwisko FROM pracownicy");
?>

<form method="POST">
    <label>Nr rejestracyjny</label>
    <input type="text" name="nr_rej"><br>

    <label>Marka</label>
    <input type="text" name="marka"><br>

    <label>Model</label>
    <input type="text" name="model"><br>

    <label>Typ silnika</label>
    <input type="text" name="typ_silnika"><br>

    <label>Pracownik</label>
    <select name="pracownik" required>
        <option value="">-- Wybierz pracownika --</option>
        <?php
        while ($row = mysqli_fetch_assoc($pracownicy_result)) {
            echo "<option value='{$row['id_pracownika']}'>{$row['imie']} {$row['nazwisko']}</option>";
        }
        ?>
    </select><br>

    <label>Aktualny przebieg</label>
    <input type="number" name="aktualny_przebieg"><br>

    <label>Data przyjazdu</label>
    <input type="date" name="data_przyjazdu"><br>

    <label>Data odjazdu</label>
    <input type="date" name="data_odjazdu"><br>

    <button type="submit">DODAJ POJAZD</button>
</form>

<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nr_rej = $_POST['nr_rej'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $typ_silnika = $_POST['typ_silnika'];
    $pracownik = $_POST['pracownik']; 
    $aktualny_przebieg = $_POST['aktualny_przebieg'];
    $data_przyjazdu = $_POST['data_przyjazdu'];
    $data_odjazdu = $_POST['data_odjazdu'];

    if ($nr_rej === '') $errors[] = "Nr rejestracyjny jest wymagany!";
    if ($marka === '') $errors[] = "Marka jest wymagana!";
    if ($model === '') $errors[] = "Model jest wymagany!";
    if ($typ_silnika === '') $errors[] = "Typ silnika jest wymagany!";
    if ($pracownik === '') $errors[] = "Pracownik musi być wybrany!";
    if ($aktualny_przebieg === '' || !is_numeric($aktualny_przebieg)) $errors[] = "Aktualny przebieg musi być liczbą!";
    if ($data_przyjazdu === '') $errors[] = "Data przyjazdu jest wymagana!";
    if ($data_odjazdu === '') $errors[] = "Data odjazdu jest wymagana!";
    if ($data_przyjazdu > $data_odjazdu) $errors[] = "Data przyjazdu nie może być późniejsza niż data odjazdu!";

    $sql = "INSERT INTO pojazdy (Nr_rejestracyjny, Marka, Model, Typ_Silnika, Pracownik, Aktualny_pzebieg, Data_przyjazdu, Data_odjazdu)
            VALUES ('$nr_rej', '$marka', '$model', '$typ_silnika', '$pracownik', '$aktualny_przebieg', '$data_przyjazdu', '$data_odjazdu')";

    if(mysqli_query($conn, $sql)){ 
        echo "Rekord dodany!"; 
        header("Location: pojazdy.php"); 
        exit; 
    }else{ 
        echo "Błąd: " . mysqli_error($conn); 
    } 
}

?>

</body>
</html>
