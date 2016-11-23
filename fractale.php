<?php

function errors($input)
{
  if (empty($input['iterations']) || empty($input['degre']))
    echo "Remplis tous les champs mec.";
}

if (empty($_POST))
  echo "Entrez le nombre d'iteration et le degre.";
else
  errors($_POST);
?>
