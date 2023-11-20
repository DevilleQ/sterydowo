<?php
    session_start();

    if (!isset($_SESSION["username"])) {
        echo 'Aby utworzyć zamówienie musisz być zalogowany. <a href="login.php">Zaloguj</a>';
        //header('Location: login.php');
    }else{
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "sterydowo";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Sprawdzenie połączenia
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Pobranie danych do nowego zamówienia (to są przykładowe dane, dostosuj do swoich potrzeb)
    
        // Pobranie nazwy klienta z sesji
        $customerName = $_SESSION["username"];
    
        // Pobranie ID klienta na podstawie nazwy klienta
        $sqlCustomerId = "SELECT id_klienta FROM klienci WHERE login = '$customerName'";
        $resultCustomerId = $conn->query($sqlCustomerId);
        $row = $resultCustomerId->fetch_assoc();
        $customerId = $row["id_klienta"];

        // Inicjalizacja pustej zmiennej string $order
        $order = '';

        // Pętla przypisująca wartości z $_SESSION['cart'] do $order
        foreach ($_SESSION['cart'] as $cartItem) {
            $order .= $cartItem.','; // Dodaj ID produktu i przecinek do zmiennej $order
        }
        $order = rtrim($order, ',');
        //echo $order;

        $fullPrice = $_SESSION['fullPrice'];

        $result = $conn->query("SELECT MAX(id_zamowienia) as max_id FROM zamowienia");
        $row = $result->fetch_assoc();
        $next_id = $row["max_id"] + 1;
        // Przygotowanie zapytania SQL
        $sql = "INSERT INTO zamowienia (id_zamowienia, id_klienta, zamowienie, cena) VALUES ('$next_id', '$customerId', '$order', $fullPrice)";
    
        // Wykonanie zapytania SQL
        if ($conn->query($sql) === TRUE) {
            echo "Nowe zamówienie o numerze: $next_id zostało utworzone.";
        } else {
            echo "Błąd podczas tworzenia zamówienia: " . $conn->error;
        }
    
        // Zakończenie połączenia
        $conn->close();
    }


   

?>