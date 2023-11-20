<?php
// Rozpocznij sesję (jeśli nie została jeszcze rozpoczęta)
session_start();

// Zakończ sesję (wyloguj użytkownika)
session_destroy();

// Przekieruj użytkownika na inną stronę po wylogowaniu
header("Location: index.php");
exit();
?>
