<?php
function error()
{
    if (empty($_POST["submit"]))
        return "Entrez le nombre d'itération et le degré.";
    else {
        if (empty($_POST['iterations']))
            $iteration = 50;
        if (empty($_POST['degre']))
            $degre = 2;
        if (preg_match("/[^0-9]/", $_POST['iterations']))
            return "Format invalide iteration";
        else if (preg_match("/[^0-9]/", $_POST['degre']))
            return "Format invalide degre";
        else
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
