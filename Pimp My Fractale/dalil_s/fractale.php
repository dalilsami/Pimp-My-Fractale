<?php
function error()
{
    $error = '';
    if (empty($_GET["submit"]))
        return "Entrez le nombre d'itération et le degré.";
    else {
        if (empty($_GET['iterations']))
            $iteration = 50;
        if (empty($_GET['degre']))
            $degre = 2;
        if (preg_match("/[^0-9]/", $_GET['iterations']) || preg_match("/[^0-9]/", $_GET['degre'])) {
            if (preg_match("/[^0-9]/", $_GET['iterations']))
                $error .= "Le nombre d'itération n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            if (preg_match("/[^0-9]/", $_GET['degre']))
                $error .= "Le dégré n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            return $error;
        } else
            return false;
//    $image = imagecreatetruecolor(800, 600);
//    $white = imagecolorallocate($image, 255, 255, 255);
//    imagefilledrectangle($image, 100, 100, 700, 500, $white);
//    imagejpeg($image, 'test.jpg');
//    imagedestroy($image);
    }
}

function draw()
{
}

?>
