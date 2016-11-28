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
    $repere_x = -1.35;
    $x2 = 1.35;
    $repere_y = -1.2;
    $y2 = 1.2;
    $zoom = 200;
    $iterations_max = $nb_iterations;

    $image_x = ($x2 - $repere_x) * $zoom;
    $image_y = ($y2 - $repere_y) * $zoom;

    $image = imagecreatetruecolor($image_x, $image_y);
    $blanc = imagecolorallocate($image, 255, 255, 255);
    $noir = imagecolorallocate($image, 0, 0, 0);
    imagefill($image, 0, 0, $blanc);

    $couleur = array();
    for ($i = 0; $i < $iterations_max; $i++)
        $couleur[$i] = imagecolorallocate($image, $i * 155 / $iterations_max, $i * 135 / $iterations_max, 255);

    for ($x = 0; $x < $image_x; $x++) {
        for ($y = 0; $y < $image_y; $y++) {
            $c = new complex();
            $c->float = $x / $zoom + $repere_x;
            $c->imaginary = $y / $zoom + $repere_y;
            $z = new complex();
            $z->float = 0;
            $z->imaginary = 0;
            $i = 0;

            do {
                $z = $z->add_complex($z->pow_complex($z, 2), $c);
                $i++;
            } while (sqrt($z->float * $z->float + $z->imaginary * $z->imaginary) < 2 AND $i < $iterations_max);
	    
            if ($i == $iterations_max)
                imagesetpixel($image, $x, $y, $noir);
            else
                imagesetpixel($image, $x, $y, $couleur[$i]);
        }
    }
    imagejpeg($image, './fractale.jpg');
}
?>
