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
        <a href="index.php">Start</a>
        <a href="onas.php">O nas</a>
        <a href="produkty.php">Nasze produkty</a>
        <a href="kontakt.php">Kontakt</a>
        <a href="dbedit.php">DB Edit</a>

        <?php
        session_start();
        if (!isset($_SESSION["isUserLoggedIn"])) {
            $_SESSION["isUserLoggedIn"] = 'false'; // Tutaj możesz ustawić wartość domyślną
        }

        // Załóżmy, że $isUserLoggedIn to zmienna przechowująca informację o zalogowaniu użytkownika
        if (!isset($_SESSION["username"])) {
            echo '<a href="login.php">Zaloguj</a>';
        } else {
            echo '<a href="user.php">' . $_SESSION["username"] . '</a>';
        }

        if (!isset($_SESSION["isAdmin"])) {
            $_SESSION["isAdmin"] = 0; // Tutaj możesz ustawić wartość domyślną
        }

        // Załóżmy, że $isUserLoggedIn to zmienna przechowująca informację o zalogowaniu użytkownika
        if ($_SESSION["isAdmin"] == 1) {
            echo '<a href="admintools.php">Narzędzia administracyjne</a>';
        } else {
        }
        ?>
    </nav>
    <section>
        <form method="post" action="">
            <label for="kategoria">Wybierz kategorię:</label>
            <select name="kategoria" id="kategoria">
                <option value="wszystkie">Wszystkie</option>
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

                // Zapytanie SQL do pobrania unikalnych kategorii
                $sqlCategories = "SELECT DISTINCT kategoria FROM produkty";
                $resultCategories = $conn->query($sqlCategories);

                // Wyświetlanie opcji dla kategorii
                if ($resultCategories->num_rows > 0) {
                    while ($rowCategory = $resultCategories->fetch_assoc()) {
                        echo '<option value="' . $rowCategory['kategoria'] . '">' . $rowCategory['kategoria'] . '</option>';
                    }
                }

                // Zakończenie połączenia
                $conn->close();
                ?>
            </select>
            <button type="submit">Filtruj</button>
        </form>
    </section>
    <main>
        <div class="products-grid">
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

            // Pobranie wybranej kategorii z formularza
            $selectedCategory = isset($_POST['kategoria']) ? $_POST['kategoria'] : 'wszystkie';

            // Zapytanie SQL z uwzględnieniem wybranej kategorii
            $sql = "SELECT * FROM produkty";

            if ($selectedCategory !== 'wszystkie') {
                $sql .= " WHERE kategoria = '$selectedCategory'";
            }

            $result = $conn->query($sql);

            // Wyświetlanie produktów w formie siatki
            echo '<div class="produkty-container">';

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="produkt-container">';

                    // Dodanie znacznika img przed nazwą
                    if (!empty($row['img'])) {
                        echo '<img src="' . $row['img'] . '" alt="' . $row['nazwa'] . '">';
                    }

                    echo '<h3>' . $row['nazwa'] . '</h3>';
                    echo '<p>Cena: ' . $row['cena'] . ' zł</p>';
                    echo '<p>Producent: ' . $row['producent'] . '</p>';
                    //echo '<p>Opis: ' . $row['opis'] . '</p>';
                    echo '<form action="addToCart.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id_produktu'] . '">';
                    echo '<button type="submit">Dodaj do koszyka</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo 'Brak produktów do wyświetlenia.';
            }

            echo '</div>';

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
