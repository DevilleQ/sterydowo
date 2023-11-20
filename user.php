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
            <?php
            echo $_SESSION['username'];
            ?>
        </h1>
    </section>
    <main class="log">
        <?php
            echo '<form action="process_logout.php" method="post">';
            echo '    <button type="submit">Wyloguj się</button>';
            echo '</form>';
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