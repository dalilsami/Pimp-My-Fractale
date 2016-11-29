<?php
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
        if ($iteration > 300 || $degre > 15) {
            if ($iteration > 300)
                $error .= "Le nombre d'itération doit être compris entre 1 et 300.<br>";
            if ($degre > 15)
                $error .= "Le degré doit être compris entre 2 et 15.<br>";
            return $error;
        }
        return false;
    }
}


function draw_mandelbrot($iterations_max, $degre)
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
    for ($i = 0; $i < $iterations_max; $i++)
        $gradient[$i] = imagecolorallocate($image, 255 * $i / $iterations_max + 1, 255 * $i / $iterations_max + 1, 255 * $i / $iterations_max + 1);

    for ($x = 0; $x < $size_x; $x++) {
        for ($y = 0; $y < $size_y / 2; $y++) {
            $float_c = $x / $zoom - $repere_x;
            $imaginary_c = $y / $zoom - $repere_y;
            $float_z = 0;
            $imaginary_z = 0;
            $i = 0;

            do {
                $old_float_z = $float_z;
                $old_imaginary_z = $imaginary_z;
                $float_z = pow($old_float_z * $old_float_z + $old_imaginary_z * $old_imaginary_z, $degre / 2);
                $imaginary_z = pow($old_float_z * $old_float_z + $old_imaginary_z * $old_imaginary_z, $degre / 2);
                $float_z = $float_z * cos($degre * atan2($old_imaginary_z, $old_float_z)) + $float_c;
                $imaginary_z = $imaginary_z * sin($degre * atan2($old_imaginary_z, $old_float_z)) + $imaginary_c;
                $i++;
            } while (sqrt($float_z * $float_z + $imaginary_z * $imaginary_z) < 2 && $i < $iterations_max);

            if ($i == $iterations_max)
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
