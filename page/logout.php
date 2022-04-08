<?php
session_start();

if (isset($_SESSION["pseudo"]) && isset($_SESSION["id"])) {
    unset($_SESSION["pseudo"]);
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    unset($_SESSION["toUser"]);
    session_destroy();
    header(('Location: ../index.php'));
}