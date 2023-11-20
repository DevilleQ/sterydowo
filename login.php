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
    </nav>
    <section>
        <h1>
            Logowanie
        </h1>
    </section>
    <main class="log">
        <!-- Formularz logowania -->
        <?php
            session_start();
            //echo ($_SESSION['username']);
            if (!isset($_SESSION["username"])) {
                echo '<form action="process_login.php" method="post">';
                echo '    <label for="username">Nazwa użytkownika:</label>';
                echo '    <input type="text" id="username" name="username" required><br>';
                echo '    <label for="password">Hasło:</label>';
                echo '    <input type="password" id="password" name="password" required>';
                echo '    <button type="submit">Zaloguj</button>';
                echo '</form>';
                echo '<a href="rejestracja.php">Nie masz konta?</a>';
            } else {
                echo '<p>Witaj, ' . $_SESSION['username'] . '! Jesteś już zalogowany.</p>';
            }
        ?>
    </main>
    <footer>
        Stronę wykonał: 2137
    </footer>
    <div class="cart">
        <a href="cart.php">
            <img src="img/koszyk.png">
        </a>
    </div>
</body>
</html>