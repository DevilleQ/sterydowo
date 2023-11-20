<?php
// Przykład pliku process_register.php

// Rozpocznij sesję (jeśli nie została jeszcze rozpoczęta)
session_start();

// Sprawdzenie, czy przesłano formularz rejestracji
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie i sprawdzenie poprawności danych rejestracji (to tylko przykład, implementuj bezpieczny mechanizm)
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Połączenie z bazą danych (ustaw odpowiednie dane dostępu do bazy danych)
    $servername = "127.0.0.1";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "sterydowo";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Sprawdzenie połączenia z bazą danych
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT MAX(id_klienta) as max_id FROM klienci");
    $row = $result->fetch_assoc();
    $next_id = $row["max_id"] + 1;

    // Zapytanie SQL do dodania nowego użytkownika
    $sql = "INSERT INTO klienci (id_klienta, imie, nazwisko, email, login, haslo) 
            VALUES ('$next_id','$name', '$lastname', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Użytkownik został pomyślnie zarejestrowany
        echo "Rejestracja zakończona sukcesem. Możesz się teraz zalogować.";
    } else {
        // Błąd podczas rejestracji
        echo "Błąd rejestracji: " . $conn->error;
    }

    // Zamknij połączenie z bazą danych
    $conn->close();
}
?>