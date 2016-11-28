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

 
function draw_mandelbrot($nb_iterations)
{
    $x1 = -2.1;
    $x2 = 0.6;
    $y1 = -1.2;
    $y2 = 1.2;
    $zoom = 200;
    $iterations_max = $nb_iterations;

    $image_x = ($x2 - $x1) * $zoom;
    $image_y = ($y2 - $y1) * $zoom;

    $image = imagecreatetruecolor($image_x, $image_y);
    $blanc = imagecolorallocate($image, 255, 255, 255);
    $noir = imagecolorallocate($image, 0, 0, 0);
    imagefill($image, 0, 0, $blanc);

    $couleur = array();
    for ($i = 0; $i < $iterations_max; $i++)
        $couleur[$i] = imagecolorallocate($image, $i * 155 / $iterations_max, $i * 135 / $iterations_max, 255);

    for ($x = 0; $x < $image_x; $x++) {
        for ($y = 0; $y < $image_y; $y++) {
            $c_r = $x / $zoom + $x1;
            $c_i = $y / $zoom + $y1;
            $z_r = 0;
            $z_i = 0;
            $i = 0;

            do {
                $old_z_r = $z_r;
                $old_z_i = $z_i;
                $z_r = pow($old_z_r, 2) - pow($old_z_i, 2) + $c_r;
                $z_i = 2 * $old_z_r * $old_z_i + $c_i;
                $i++;
            } while (sqrt($z_r * $z_r + $z_i * $z_i) < 2 AND $i < $iterations_max);

            if ($i == $iterations_max) {
                imagesetpixel($image, $x, $y, $noir);
            } else {
                imagesetpixel($image, $x, $y, $couleur[$i]);
            }
        }
    }
    imagejpeg($image, './fractale.jpg');
}

?>
