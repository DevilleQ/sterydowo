<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <img src="img/logolowres.png">
    </header>
    <nav>
        <a href="index.php">
            Start
        </a>
        <a href="onas.php">
            O nas
        </a>
        <a href="produkty.php">
            Nasze produkty
        </a>
        <a href="kontakt.php">
            Kontakt
        </a>
        <a href="dbedit.php">
            DB Edit
        </a>
        <?php
            session_start();
            if (!isset($_SESSION["isUserLoggedIn"])) {
                $_SESSION["isUserLoggedIn"] = 'false'; // Tutaj możesz ustawić wartość domyślną
            }
            // Załóżmy, że $isUserLoggedIn to zmienna przechowująca informację o zalogowaniu użytkownika
            if (!isset($_SESSION["username"])) {
                echo '<a href="login.php">Zaloguj</a>';
            }else{
                echo '<a href="user.php">'.$_SESSION["username"].'</a>';
            }


            if (!isset($_SESSION["isAdmin"])) {
                $_SESSION["isAdmin"] = 0; // Tutaj możesz ustawić wartość domyślną
            }
            // Załóżmy, że $isUserLoggedIn to zmienna przechowująca informację o zalogowaniu użytkownika
            if ($_SESSION["isAdmin"]== 1) {
                echo '<a href="admintools.php">Narzędzia administracyjne</a>';
            }else{
                
            }
            
        ?>
    </nav>
    <section>
        <h1>
            Zamówienia
        </h1>
    </section>
    <main>
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

// Zapytanie SQL do pobrania danych zamówień z nazwami produktów
$sql = "SELECT zamowienia.id_zamowienia, zamowienia.id_klienta, zamowienia.zamowienie, zamowienia.cena, GROUP_CONCAT(produkty.nazwa) AS produkty
        FROM zamowienia
        INNER JOIN produkty ON FIND_IN_SET(produkty.id_produktu, zamowienia.zamowienie)
        GROUP BY zamowienia.id_zamowienia";
$result = $conn->query($sql);

// Sprawdzenie, czy są jakieś zamówienia
if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID Zamówienia</th><th>ID Klienta</th><th>Produkty</th><th>Cena</th></tr>';

    // Wyświetlanie danych zamówień w tabeli
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id_zamowienia'] . '</td>';
        echo '<td>' . $row['id_klienta'] . '</td>';
        
        // Zamiana zamówienia na tablicę produktów
        $orderProducts = array_count_values(explode(',', $row['zamowienie']));
        echo '<td>';
        foreach ($orderProducts as $productId => $quantity) {
            $productName = fetchProductName($conn, $productId);
            echo $productName . ': ' . $quantity . ' szt.<br>';
        }
        echo '</td>';

        echo '<td>' . $row['cena'] . ' zł</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'Brak zamówień do wyświetlenia.';
}

// Zakończenie połączenia
$conn->close();

// Funkcja do pobierania nazwy produktu na podstawie ID
function fetchProductName($conn, $productId) {
    $sql = "SELECT nazwa FROM produkty WHERE id_produktu = '$productId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nazwa'];
    } else {
        return 'Produkt nieznany';
    }
}
?>
    </main>
    <footer>
        <p>
        © 2023 Sterydowo. Wszelkie prawa zastrzeżone.
        </p>
    </footer>
    <div class="cart">
        <a href="cart.php">
            <img src="img/koszyk.png">
        </a>
    </div>
</body>
</html>