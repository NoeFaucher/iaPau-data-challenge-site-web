<?php
function valid ($info): string
{
    $info = trim($info);
    $info = stripcslashes($info);
    return htmlspecialchars($info);

}

function estInjectionSQL($chaine) {
    // Liste des mots clés SQL potentiellement dangereux
    $motsCles = array("SELECT", "UPDATE", "DELETE", "INSERT", "DROP", "TABLE", "FROM", "WHERE", "UNION", "JOIN", "ORDER BY", "GROUP BY");

    // Conversion de la chaîne en lettres majuscules pour simplifier la comparaison
    $chaine = strtoupper($chaine);

    // Vérification de la présence de chaque mot clé dans la chaîne
    foreach ($motsCles as $mot) {
        if (strpos($chaine, $mot) !== false) {
        return true; // Injection SQL détectée
        }
    }

    return false; // La chaîne ne contient pas d'injection SQL
}

?>