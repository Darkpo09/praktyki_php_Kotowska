<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dod_ocene.css">
    <title>Dodaj ocenę</title>
</head>
<body>
    <div class="container">
        <h2>Dodaj ocenę dla ucznia</h2>
        <form action="dodaj_ocene.php" method="POST">
            <label for="uczen">Wybierz ucznia:</label>
            <select name="uczen" id="uczen" required>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                // Połączenie z bazą danych
                $host = 'localhost';
                $db = 'praktyki_3';
                $user = 'root';
                $pass = '';

                $conn = new mysqli($host, $user, $pass, $db);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Pobieranie listy uczniów z bazy danych
                $result = $conn->query("SELECT id, imie, nazwisko FROM uczniowie_2c");

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['imie']} {$row['nazwisko']}</option>";
                }

                $conn->close();
                ?>
            </select>

            <label for="ocena">Wprowadź ocenę:</label>
            <input type="number" name="ocena" id="ocena" min="1" max="6" required>

            <button type="submit">Dodaj ocenę</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uczen_id = $_POST['uczen'];
            $ocena = $_POST['ocena'];

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Przygotowanie zapytania SQL do aktualizacji oceny w tabeli uczniowie_2c
            $stmt = $conn->prepare("UPDATE uczniowie_2c SET ocena = ? WHERE id = ?");
            $stmt->bind_param("ii", $ocena, $uczen_id);

            if ($stmt->execute()) {
                echo "<div class='message success'>Ocena została dodana pomyślnie!</div>";
            } else {
                echo "<div class='message error'>Błąd: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>


    </div>

    <a href="index.php" class="powrot">Powrót do strony głównej</a>
</body>
</html>
