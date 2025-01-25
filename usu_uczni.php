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

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyrzuć ucznia</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(123, 55, 49);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #2C0703;
        }

        .container {
            background-color: #DA9F93;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        h2 {
            color: #2C0703;
            font-size: 30px;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            color: #2C0703;
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 15px;
            margin-bottom: 25px;
            border: 2px solid #890620;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background-color: #EBD4CB;
        }

        select:focus {
            border-color: #B6465F;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #890620;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #B6465F;
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
            color: #890620;
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
</body>
</html>
