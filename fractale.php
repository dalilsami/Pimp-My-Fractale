<?php

function errors()
{
  echo "Remplis tous les champs mec.";
}

function fractale($input)
{
  if (empty($input))
    echo "Entrez le nombre d'iteration et le degre.";
  else if (!empty($input['iterations']) && !empty($input['degre']))
  {
    $image = imagecreatetruecolor(800, 600);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefilledrectangle($image, 100, 100, 700, 500, $white);
    imagejpeg($image, 'test.jpg');
    imagedestroy($image);
    echo "done";
  }
  else
    errors();
}
?>
