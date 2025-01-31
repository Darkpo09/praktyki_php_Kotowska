<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="uczniowie.css">
    <title>Uczniowie 2c</title>
</head>
<body>
    <h1>Lista uczniów klasy 2c</h1>
    <?php
    
    $host = 'localhost';
    $db = 'praktyki_3';
    $user = 'root';
    $pass = '';


    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $query = "SELECT * FROM uczniowie_2c";
        $stmt = $pdo->query($query);


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="student">';
            echo '<h3>' . htmlspecialchars($row['imie'] . ' ' . $row['nazwisko']) . '</h3>';
            echo '<p><strong>Numer w dzienniku:</strong> ' . htmlspecialchars($row['numer_w_dzienniku']) . '</p>';
            echo '<p><strong>Zachowanie:</strong> ' . htmlspecialchars($row['zachowanie']) . '</p>';
            echo '<p><strong>Średnia końcowa:</strong> ' . htmlspecialchars($row['srednia_koncowa']) . '</p>';
            echo '<p><strong>Ocena:</strong> ' . htmlspecialchars($row['ocena']) . '</p>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo '<p>Błąd połączenia z bazą danych: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
</body>
</html>
