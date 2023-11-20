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
            Koszyk
        </h1>
    </section>
    <main>
        <div class="produkty-container">
        <?php
            // Odkomentuj poniższą linię, jeśli korzystasz z sesji
            // session_start();

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

            // Sprawdzenie, czy tablica 'cart' istnieje w sesji
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                // Sprawdzenie, czy dane przekazano poprzez formularz
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Sprawdzenie, czy przekazano ID produktu i ilość
                    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
                        $productId = $_POST['product_id'];
                        $quantity = $_POST['quantity'];

                        // Sprawdzenie, czy produkt o danym ID istnieje w koszyku
                        if (in_array($productId, $_SESSION['cart'])) {
                            // Aktualizacja ilości sztuk w koszyku
                            $_SESSION['cart'] = array_merge(
                                array_diff($_SESSION['cart'], [$productId]),
                                array_fill(0, $quantity, $productId)
                            );
                        }
                    }

                    // Sprawdzenie, czy przekazano ID produktu do usunięcia
                    if (isset($_POST['remove_product_id'])) {
                        $removeProductId = $_POST['remove_product_id'];

                        // Usunięcie produktu z koszyka
                        $_SESSION['cart'] = array_diff($_SESSION['cart'], [$removeProductId]);
                    }
                }

                // Pobranie unikalnych ID produktów z koszyka wraz z ich ilościami
                    $cartItems = array_count_values($_SESSION['cart']);

                    // Sprawdzenie, czy są jakieś produkty w koszyku
                    if (!empty($cartItems)) {
                        // Wygenerowanie warunków dla zapytania SQL
                        $conditions = implode(",", array_keys($cartItems));

                        // Zapytanie SQL
                        $sql = "SELECT * FROM produkty WHERE id_produktu IN ($conditions)";
                        $result = $conn->query($sql);


                // Wyświetlanie produktów
                $fullPrice = 0;
                if ($result->num_rows > 0) {
                    echo '<div class="produkty-w-koszyku">';
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row['id_produktu'];
                        $productName = $row['nazwa'];
                        $productPrice = $row['cena'];
                        $productProducer = $row['producent'];
                        $quantityInCart = $cartItems[$productId];
                        $totalPrice = $productPrice * $quantityInCart;
                        $fullPrice = $fullPrice + $totalPrice;

                        echo '<div class="produkt-w-koszyku">';
                        echo "<h3>$productName</h3>";
                        echo "<p>Cena: $productPrice zł</p>";
                        echo "<p>Producent: $productProducer</p>";
                        echo "<p>Ilość w koszyku: $quantityInCart</p>";
                        echo "<p>Cena razem: $totalPrice zł</p>";

                        // Formularz modyfikacji ilości sztuk
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="product_id" value="' . $productId . '">';
                        echo '<label for="quantity">Nowa ilość:</label>';
                        echo '<input type="number" name="quantity" value="' . $quantityInCart . '" min="1">';
                        echo '<button type="submit">Zmień ilość</button>';
                        echo '</form>';

                        // Formularz usunięcia produktu
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="remove_product_id" value="' . $productId . '">';
                        echo '<button type="submit">Usuń z koszyka</button>';
                        echo '</form>';
                        echo '<br>';
                        echo '</div>';
                    }
                    echo '<b>Podsumowanie </b>';
                    echo $fullPrice. ' zł<br>';
                    $_SESSION['fullPrice']= $fullPrice;
                    echo '<form method="post" action="createOrder.php">';
                    echo '<button type="submit">Zamów</button>';
                    echo '</form>';
                    echo '</div>';
                
                } else {
                    echo 'Brak produktów w koszyku.';
                }
                } else {
                echo 'Koszyk jest pusty.';
                }
            }

            // Zakończenie połączenia
            $conn->close();
        ?>




        </div>
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