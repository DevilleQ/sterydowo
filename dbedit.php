<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    display: grid;
    gap: 15px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
    padding: 10px;
    border: none;
    border-radius: 4px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <h1>Dodawanie Produktu</h1>

    <?php
    // Połączenie z bazą danych
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "sterydowo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Sprawdzenie połączenia
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sprawdzenie, czy formularz został przesłany
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pobranie danych z formularza
        $nazwa = $_POST["nazwa"];
        $cena = $_POST["cena"];
        $img = $_POST["img"]; // Zakładam, że to jest URL obrazu
        $opis = $_POST["opis"];
        $producent = $_POST["producent"];

        // Znalezienie obecnie największego ID
        $result = $conn->query("SELECT MAX(id_produktu) as max_id FROM produkty");
        $row = $result->fetch_assoc();
        $next_id = $row["max_id"] + 1;

        // Przygotowanie zapytania SQL z użyciem manualnie ustawionego ID
        $sql = "INSERT INTO produkty (id_produktu, nazwa, cena, img, opis, producent) VALUES ($next_id, '$nazwa', $cena, '$img', '$opis', '$producent')";

        // Wykonanie zapytania
        if ($conn->query($sql) === TRUE) {
            echo "Produkt został dodany do bazy danych.";
        } else {
            echo "Błąd: " . $sql . "<br>" . $conn->error;
        }
    }

    // Zakończenie połączenia
    $conn->close();
    ?>

    <form action="" method="post">
        <!-- Nie trzeba wprowadzać ID ręcznie -->
        <label for="nazwa">Nazwa Produktu:</label>
        <input type="text" name="nazwa" required><br>

        <label for="cena">Cena:</label>
        <input type="number" name="cena" required><br>

        <label for="img">URL Obrazu:</label>
        <input type="text" name="img"><br>

        <label for="opis">Opis:</label>
        <textarea name="opis" rows="4" ></textarea><br>

        <label for="producent">Producent:</label>
        <input type="text" name="producent" required><br>

        <input type="submit" value="Dodaj Produkt">
    </form>
    <a href="admintools.php">
        <input type="submit" value="Wróć">
    </a>
</body>
</html>