<?php

    session_start();
    if (!isset($_SESSION["estconnecte"])) {
        $_SESSION["estconnecte"] = false;
    }
    
?>