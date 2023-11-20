<?php
// Przykład pliku process_login.php

// Rozpocznij sesję (jeśli nie została jeszcze rozpoczęta)
session_start();

// Sprawdzenie, czy przesłano formularz logowania
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie i sprawdzenie poprawności danych logowania (to tylko przykład, implementuj bezpieczny mechanizm)
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

    // Zapytanie SQL do weryfikacji danych logowania
    $sql = "SELECT * FROM klienci WHERE login = '$username' AND haslo = '$password'";
    $result = $conn->query($sql);

    // Sprawdzenie wyników zapytania
    if ($result->num_rows > 0) {
        // Pobranie danych użytkownika
        $userData = $result->fetch_assoc();

        // Sprawdzenie wartości isAdmin
        $isAdminValue = $userData['isAdmin'];

        // Jeśli dane są poprawne i isAdmin jest równe 1, ustaw zmienne sesji
        if ($isAdminValue == 1) {
            $_SESSION["isUserLoggedIn"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["isAdmin"] = 1;
            echo $_SESSION['isAdmin'];

            // Przekieruj użytkownika na inną stronę po udanym zalogowaniu
            header("Location: index.php");
            exit();
        } else {
            // Jeśli isAdmin nie jest równe 1, przekieruj na standardową stronę
            $_SESSION["isUserLoggedIn"] = true;
            $_SESSION["username"] = $username;
            
            header("Location: user.php");
            exit();
        }
    } else {
        // Jeśli dane są niepoprawne, możesz wyświetlić komunikat błędu lub podjąć inne działania
        echo "Błędne dane logowania. Spróbuj ponownie.";
    }

    // Zamknij połączenie z bazą danych
    $conn->close();
}
?>
