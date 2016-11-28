<?php
require 'complex.php';

function error()
{
    $error = '';

    if (empty($_GET["submit"]))
        return "Entrez le nombre d'itération et le degré.";
    else {
        if (empty($_GET['iterations']))
            $iteration = 50;
        else
            $iteration = (int)$_GET['iterations'];
        if (empty($_GET['degre']))
            $degre = 2;
        else
            $degre = (int)$_GET['degre'];
        if (preg_match("/[^0-9]/", $_GET['iterations']) || preg_match("/[^0-9]/", $_GET['degre'])) {
            if (preg_match("/[^0-9]/", $_GET['iterations']))
                $error .= "Le nombre d'itération n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            if (preg_match("/[^0-9]/", $_GET['degre']))
                $error .= "Le degré n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            return $error;
        }
        if ($iteration > 1000 || $degre > 15) {
            if ($iteration > 1000)
                $error .= "Le nombre d'itération doit être compris entre 1 et 1000.<br>";
            if ($degre > 15)
                $error .= "Le degré doit être compris entre 2 et 15.<br>";
            return $error;
        }
        return false;
    }
}


function draw_mandelbrot($nb_iterations, $degre)
{
    $repere_x = 2.05;
    $repere_y = 1.15;
    $zoom = 300;

    $taille_x = 2 * $repere_x * $zoom;
    $taille_y = 2 * $repere_y * $zoom;

    $image = imagecreatetruecolor($taille_x, $taille_y);
    $blanc = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $blanc);

    $couleurs = [];
    for ($i = 0; $i < $nb_iterations; $i++)
        $couleurs[$i] = imagecolorallocate($image, 255 * $i / $nb_iterations, 255 * $i / $nb_iterations, 255 * $i / $nb_iterations);

    for ($x = 0; $x < $taille_x; $x++) {
        for ($y = 0; $y < $taille_y; $y++) {
            $c = new complex();
            $c->float = $x / $zoom - $repere_x;
            $c->imaginary = $y / $zoom - $repere_y;

            $z = new complex();
            $z->float = 0;
            $z->imaginary = 0;

            $i = 0;

            do {
                $z = $z->add_complex($z->pow_complex($z, $degre), $c);
                $i++;
            } while (sqrt(pow($z->float, 2) + pow($z->imaginary, 2)) < 2 AND $i < $nb_iterations);

            if ($i == $nb_iterations)
                imagesetpixel($image, $x, $y, $blanc);
            else
                imagesetpixel($image, $x, $y, $couleurs[$i]);
        }
    }
    imagejpeg($image, './fractale.jpg');
}
