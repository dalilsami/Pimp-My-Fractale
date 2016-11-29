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


function draw_fractal($float, $imaginary, $nb_iterations, $degre)
{
    $repere_x = 2.05;
    $repere_y = 1.5;
    $zoom = 200;

    $size_x = 2 * $repere_x * $zoom;
    $size_y = 2 * $repere_y * $zoom;

    $image = imagecreatetruecolor($size_x, $size_y);
    $symmetry = imagecreatetruecolor($size_x, $size_y);
    $white = imagecolorallocate($image, 255, 255, 255);

    $gradient = [];
    for ($i = 0; $i < $nb_iterations; $i++)
        $gradient[$i] = imagecolorallocate($image, 255 * $i / $nb_iterations + 1, 255 * $i / $nb_iterations + 1, 255 * $i / $nb_iterations + 1);

    for ($x = 0; $x < $size_x; $x++) {
        for ($y = 0; $y < $size_y / 2; $y++) {
            $float_c = $x / $zoom - $repere_x;
            $imaginary_c = $y / $zoom - $repere_y;
            $float_z = $float;
            $imaginary_z = $imaginary;
            $i = 0;

            do {
                $old_float_z = $float_z;
                $old_imaginary_z = $imaginary_z;
                $float_z = new_value($old_float_z, $old_imaginary_z, $float_c, $degre, 0);
                $imaginary_z = new_value($old_float_z, $old_imaginary_z, $imaginary_c, $degre, 1);
                $i++;
            } while (sqrt(pow($float_z, 2) + pow($imaginary_z, 2)) < 2 && $i < $nb_iterations);

            if ($i == $nb_iterations)
                imagesetpixel($image, $x, $y, $white);
            else
                imagesetpixel($image, $x, $y, $gradient[$i]);
        }
    }
    imagecopy($symmetry, $image, 0, 0, 0, 0, $size_x, $size_y / 2);
    imageflip($symmetry, IMG_FLIP_VERTICAL);
    imagecopy($image, $symmetry, 0, $size_y / 2, 0, $size_y / 2, $size_x, $size_y);

    imagepng($image, './fractale.jpg');
}

function new_value($float, $imaginary, $const, $degree, $mode)
{
    if ($mode == 0)
        return pow(pow($float, 2) + pow($imaginary, 2), $degree / 2) * cos($degree * atan2($imaginary, $float)) + $const;
    return pow(pow($float, 2) + pow($imaginary, 2), $degree / 2) * sin($degree * atan2($imaginary, $float)) + $const;
}
