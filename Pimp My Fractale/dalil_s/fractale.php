<?php
function fractale($input)
{
    if (empty($input["submit"]))
        echo "Entrez le nombre d'itération et le degré.";
    else {
        if (empty($_POST['iterations']))
            $iteration = 50;
        if (empty($_POST['degre']))
            $degre = 2;
//    $image = imagecreatetruecolor(800, 600);
//    $white = imagecolorallocate($image, 255, 255, 255);
//    imagefilledrectangle($image, 100, 100, 700, 500, $white);
//    imagejpeg($image, 'test.jpg');
//    imagedestroy($image);
    }
}

?>
