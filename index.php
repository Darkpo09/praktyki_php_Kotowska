<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
    <style>
        body {
            background-color: #D1D2F9;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #576490;
        }

        h1 {
            background-color: #7796CB;
            color: white;
            text-align: center;
            padding: 30px 0;
            margin: 0;
            font-size: 2.5em;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        p {
            text-align: center;
            font-size: 20px;
            margin-top: 30px;
        }

        a {
            display: inline-block;
            background-color:rgb(120, 151, 230);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 25px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        a:hover {
            background-color: #C9CAD9;
            transform: translateY(-5px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }

        a:active {
            background-color: #C9CAD9;
            transform: translateY(2px);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }

        footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
            color: white;
            background-color: #576490;
            padding: 15px 0;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Witaj na stronie głównej</h1>
    <p><a href="uczniowie_2c.php">Lista uczniów 2C</a></p>
    <p><a href="dod_uczni.php">Dodaj ucznia</a></p>
    <p><a href="dodaj_ocene.php">Dodaj ocenę</a></p>
    <p><a href="usu_uczni.php">Wyrzuć ucznia ze szkoły przez okno</a></p>

    <footer>
        &copy; 2025 Twoja Szkoła. Wszelkie prawa zastrzeżone.
    </footer>
</body>
</html>
