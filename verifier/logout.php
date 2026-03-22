<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION['verifier_id']);
unset($_SESSION['verifier_name']);
header("Location: index.php?message=You have been logged out.");
exit();
?>
