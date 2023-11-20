<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Tutaj możesz dodać logikę dodawania produktu do koszyka
    // Na przykład, możesz użyć tablicy w sesji do przechowywania produktów w koszyku.
    
    // Przykładowa logika:
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Dodaj produkt do koszyka (użyj $productId)
    $_SESSION['cart'][] = $productId;
    foreach ($_SESSION['cart'] as $productId) {
        //echo $productId . ' ';
    }
    // Możesz także przekierować użytkownika z powrotem na stronę produktu lub gdziekolwiek chcesz
    header('Location: produkty.php');
} else {
    // Jeśli nie przekazano produktu, obsłuż to zgodnie z własnymi potrzebami
    echo 'Błąd: Brak przekazanego produktu.';
}
?>