<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ocenę</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(107, 146, 155);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #BBD1EA;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        h2 {
            color: #507DBC;
            font-size: 28px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        label {
            font-size: 18px;
            color: #507DBC;
            display: block;
            margin-bottom: 8px;
        }

        select, input[type="number"] {
            width: 95%;
            padding: 12px;
            margin-bottom: 25px;
            border: 2px solid #507DBC;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        select:focus, input[type="number"]:focus {
            border-color: #A1C6EA;
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #A1C6EA;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            letter-spacing: 1px;
        }

        button:hover {
            background-color: #507DBC;
        }

        .message {
            font-size: 18px;
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
        }

        .success {
            color: #388e3c;
            background-color: #c8e6c9;
        }

        .error {
            color: #d32f2f;
            background-color: #FFC1C1;
        }

        .message a {
            color: #507DBC;
            text-decoration: none;
            font-weight: bold;
        }

        .message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dodaj ocenę dla ucznia</h2>
        <form action="dodaj_ocene.php" method="POST">
            <label for="uczen">Wybierz ucznia:</label>
            <select name="uczen" id="uczen" required>
                <?php
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
</body>
</html>
