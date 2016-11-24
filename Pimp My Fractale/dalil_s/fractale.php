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
        } else if ($iteration > 1000 || $degre > 15) {
            if ($iteration > 1000)
                $error .= "Le nombre d'itération doit être compris entre 1 et 1000.<br>";
            if ($degre > 15)
                $error .= "Le degré doit être compris entre 2 et 15.<br>";
            return $error;
        } else
            return false;
    }
}

function draw_mandelbrot()
{
    $x1 = -2.1;
    $x2 = 0.6;
    $y1 = -1.2;
    $y2 = 1.2;
    $zoom = 100;
    $iterations_max = 50;

    $image_x = ($x2 - $x1) * $zoom;
    $image_y = ($y2 - $y1) * $zoom;

// on créé l'image et les couleurs, inutile ici de remplire l'image vu que on dessinera tous les pixels
    $image = imagecreatetruecolor($image_x, $image_y);
    $blanc = imagecolorallocate($image, 255, 255, 255);
    $noir = imagecolorallocate($image, 0, 0, 0);
    imagefill($image, 0, 0, $blanc);

    $debut = microtime(true);
    for ($x = 0; $x < $image_x; $x++) {
        for ($y = 0; $y < $image_y; $y++) {
            $c_r = $x / $zoom + $x1;
            $c_i = $y / $zoom + $y1;
            $z_r = 0;
            $z_i = 0;
            $i = 0;

            do {
                $tmp = $z_r;
                $z_r = $z_r * $z_r - $z_i * $z_i + $c_r;
                $z_i = 2 * $tmp * $z_i + $c_i;
                $i++;
            } while ($z_r * $z_r + $z_i * $z_i < 4 AND $i < $iterations_max);

            if ($i == $iterations_max)
                imagesetpixel($image, $x, $y, $noir);
        }
    }

    $temps = round(microtime(true) - $debut, 3);

    imagestring($image, 3, 1, 1, $temps, $noir);

    header('Content-type: image/png');
    imagejpeg($image, 'test.jpg');

}

?>
