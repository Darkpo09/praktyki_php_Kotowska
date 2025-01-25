<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
$host = 'localhost';
$db = 'praktyki_3';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

$message = ""; // Zainicjalizowanie zmiennej

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];

    $stmt = $conn->prepare("INSERT INTO uczniowie_2c (imie, nazwisko) VALUES (?, ?)");
    $stmt->bind_param("ss", $imie, $nazwisko);

    if ($stmt->execute()) {
        $message = "<div class='message success'>Uczeń został dodany pomyślnie!</div>";
    } else {
        $message = "<div class='message error'>Błąd: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ucznia</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1A3A3A;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #DDC4DD;
        }

        .container {
            background-color: #4F517D;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        h2 {
            color: #A997DF;
            font-size: 28px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        label {
            font-size: 18px;
            color: #DCCFEC;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 95%;
            padding: 12px;
            margin-bottom: 25px;
            border: 2px solid #A997DF;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background-color: #DCCFEC;
            color: #1A3A3A;
        }

        input[type="text"]:focus {
            border-color: #4F517D;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #A997DF;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4F517D;
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
            color: #D32F2F;
            background-color: #FFC1C1;
        }

        .message a {
            color: #A997DF;
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
        <h2>Dodaj nowego ucznia</h2>
        <form action="dod_uczni.php" method="POST">
            <label for="imie">Imię:</label>
            <input type="text" name="imie" id="imie" required>

            <label for="nazwisko">Nazwisko:</label>
            <input type="text" name="nazwisko" id="nazwisko" required>

            <button type="submit">Dodaj ucznia</button>
        </form>
        
        <!-- Wyświetlenie wiadomości -->
        <?php if (!empty($message)) echo $message; ?>
    </div>
</body>
</html>
