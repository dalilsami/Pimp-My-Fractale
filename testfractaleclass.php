<?php

class complex
{
    public $float = 0;
    public $imaginary = 0;

    public function add_complex($a, $b)
    {
        $c = new complex();

        $c->float = $a->float + $b->float;
        $c->imaginary = $a->imaginary + $b->imaginary;
        return $c;
    }

    public function mult_complex($a, $b)
    {
        $c = new complex();

        $c->float = $a->float * $b->imaginary - $a->imaginary * $b->float;
        $c->imaginary = $a->float * $b->imaginary + $a->imaginary * $b->float;
        return $c;
    }

    public function pow_complex($a, $p)
    {
        if ($p == 1)
            return $a;
        return $this->mult_complex($a, $this->pow_complex($a, $p - 1));
    }
}

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
            $c = new complex();
            $c->float = $x / $zoom + $x1;
            $c->imaginary = $y / $zoom + $y1;
            $z = new complex();
            $i = 0;

            do {
                $z = $z->add_complex($this->pow_complex($z, 2), $c);
                $i++;
            } while (sqrt($z->float * $z->float + $z->imaginary * $z->imaginary) < 2 AND $i < $iterations_max);

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
