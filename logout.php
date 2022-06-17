<?php 
    require __DIR__ . '/header.php';
    require "db.php";

    unset($_SESSION['logged_user']);

    header('Location: index.php');

    require __DIR__ . '/footer.php';
?>