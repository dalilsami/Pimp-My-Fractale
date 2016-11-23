<?php

function errors($input)
{
  if ($input['iteration'] == "2")
    echo "yo";  
}

if (!empty($_POST))
  errors($_POST);
else
  echo "Entrez le nombre d'iteration et le degre.";
?>
