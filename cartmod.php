<?php
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
                echo 'Liczba została zmieniona';
            }
        }

        // Sprawdzenie, czy przekazano ID produktu do usunięcia
        if (isset($_POST['remove_product_id'])) {
            $removeProductId = $_POST['remove_product_id'];

            // Usunięcie produktu z koszyka
            $_SESSION['cart'] = array_diff($_SESSION['cart'], [$removeProductId]);
            
        }
    }
}
?>
