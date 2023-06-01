<?php
session_start();
if (!isset($_SESSION["estConnecte"])) {
    $_SESSION["estConnecte"] = false;
}
?>