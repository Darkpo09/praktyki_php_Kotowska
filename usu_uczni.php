<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usu_uczni.css">
    <title>Wyrzuć ucznia</title>
</head>
<body>
    <div class="container">
        <h2>Wyrzuć ucznia</h2>
        <form action="usu_uczni.php" method="POST">
            <label for="uczen">Wybierz ucznia do wyrzucenia:</label>
            <select name="id" id="uczen" required>
                <option value="">Wybierz ucznia</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['imie'] . " " . $row['nazwisko'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Brak uczniów w bazie</option>";
                }
                ?>
            </select><br><br>

            <button type="submit">Wyrzuć ucznia</button>
        </form>

        <!-- Wyświetlenie komunikatu -->
        <?php echo $message; ?>
    </div>
    <a href="index.php" class="powrot">Powrót do strony głównej</a>

</body>
</html>


<?php
$host = 'localhost';
$db = 'praktyki_3';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];


    $sql = "DELETE FROM uczniowie_2c WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "<div class='message success'>Uczeń został skutecznie wyrzucony przez okno:)</div>";
    } else {
        $message = "<div class='message error'>Błąd: " . $stmt->error . "</div>";
    }

    $stmt->close();
}


$sql = "SELECT id, imie, nazwisko FROM uczniowie_2c";
$result = $conn->query($sql);

$conn->close();
?>


