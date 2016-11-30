<?php
function error()
{
    $error = '';

    if (empty($_GET["submit"]))
        return "Entrez le nombre d'itération et le degré.";
    else {
        if (!empty($_GET['iterations']) || $_GET['iterations'] == 0)
            $iteration = (int)$_GET['iterations'];
        else
            $iteration = 50;
        if (!empty($_GET['degre']) || $_GET['degre'] == 0)
            $degre = (int)$_GET['degre'];
        else
            $degre = 2;
        if (!preg_match("/[0-9]+$/A", $_GET['iterations']) || !preg_match("/[0-9]+([.,][0-9]+)?$/A", $_GET['degre'])) {
            if (preg_match("/[^0-9]/", $_GET['iterations']))
                $error .= "Le nombre d'itération n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            if (preg_match("/[^0-9]/", $_GET['degre']))
                $error .= "Le degré n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            return $error;
        }
        if (($iteration > 300 || $iteration < 1) || ($degre > 15 || $degre < 1)) {
            if ($iteration > 300 || $iteration < 1)
                $error .= "Le nombre d'itération doit être compris entre 1 et 300.<br>";
            if ($degre > 15 || $degre < 1)
                $error .= "Le degré doit être compris entre 1 et 15.<br>";
            return $error;
        }
        return false;
    }
}