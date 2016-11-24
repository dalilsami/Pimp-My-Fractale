<?php
function error()
{
    $error = '';
    if (empty($_POST["submit"]))
        return "Entrez le nombre d'itération et le degré.";
    else {
        if (empty($_POST['iterations']))
            $iteration = 50;
        if (empty($_POST['degre']))
            $degre = 2;
        if (preg_match("/[^0-9]/", $_POST['iterations']) || preg_match("/[^0-9]/", $_POST['degre'])) {
            if (preg_match("/[^0-9]/", $_POST['iterations']))
                $error .= "Le nombre d'itération n'est pas valide.<br>Entrez un nombre entier positif.<br>";
            else if (preg_match("/[^0-9]/", $_POST['degre']))
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
