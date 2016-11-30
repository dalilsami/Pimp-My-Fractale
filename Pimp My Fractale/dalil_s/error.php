<?php
function error_mandelbrot()
{
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
        if (preg_match("/[^0-9]/", $_GET['iterations']) || $iteration == '')
            $iteration = "Le nombre d'itération n'est pas valide.<br>Entrez un nombre entier positif.<br>";
        else if ($iteration > 300 || $iteration < 1)
            $iteration = "Le nombre d'itération doit être compris entre 1 et 300.<br>";
        /*if (preg_match("/[^0-9]/", $_GET['degre']) || $degre == '')
            $degre = "Le degré n'est pas valide.<br>Entrez un nombre entier positif.<br>";
        else if ($degre > 15 || $degre < 1)
            $degre = "Le degré doit être compris entre 1 et 15.<br>";*/
        return [$iteration, $degre];
    }
}

function error_julia()
{
    if (!empty($_GET['x']) || $_GET['x'] == 0)
        $x = (float)str_replace(',', '.', $_GET['x']);
    else
        $x = 50;
    if (!empty($_GET['y']) || $_GET['y'] == 0)
        $y = (float)str_replace(',', '.', $_GET['y']);
    else
        $y = 2;
    if (!preg_match("/[+-]?[0-9]+([.,]?[0-9]+)?$/A", $_GET['x']) || $x == '')
        $x = "La partie réelle n'est pas valide.<br>Entrez un nombre réel.<br>";
    else if ($x > 10 || $x < -10)
        $x = "La partie réelle doit être comprise entre -10 et 10.<br>";
    if (!preg_match("/[+-]?[0-9]+([.,]?[0-9]+)?$/A", $_GET['y']) || $y == '')
        $y = "La partie imaginaire n'est pas valide.<br>Entrez un nombre réel.<br>";
    else if ($y > 10 || $y < -10)
        $y = "La partie imaginaire doit être comprise entre -10 et 10.<br>";
    return [$x, $y];
}