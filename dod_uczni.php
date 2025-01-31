<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <html lang="pl"><link rel="stylesheet" href="dod_uczni.css">
    <title>Dodaj ucznia</title>
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

    <a href="index.php" class="powrot">Powrót do strony głównej</a>


    
</body>
</html>

<?php
// Włączenie raportowania błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Dane do połączenia z bazą danych
$conn = new mysqli('localhost', 'root', '', 'praktyki_3');

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$message = ""; // Inicjalizacja zmiennej na komunikaty

// Obsługa formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO uczniowie_2c (imie, nazwisko) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['imie'], $_POST['nazwisko']);
    
    // Wykonanie zapytania i ustawienie komunikatu
    $message = $stmt->execute() 
        ? "<div class='message success'>Uczeń dodany pomyślnie!</div>" 
        : "<div class='message error'>Błąd: " . $stmt->error . "</div>";
    
    $stmt->close();
    $conn->close();
}
?>


