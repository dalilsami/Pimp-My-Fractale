<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pimp My Fractale</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php include 'fractale.php' ?>
</head>
<body id="html-body">
<section id="header"><img id="pmf" src="title.png"></section>
<section id="form-container">
    <form id="calcul-form" action="#" method="get">
        <section id="form-title">Générez une fractale de l'ensemble de Mandelbrot</section>
        <section class="input-form">
            <section class="input-title">Nombre d'itération</section>
            <input class="input-number" type="text" title="Nombre d'itération" name="iterations" placeholder="50">
        </section>
        <section class="input-form">
            <section class="input-title">Degré</section>
            <input class="input-number" type="text" title="Degré" name="degre" placeholder="2">
        </section>
        <section id="submit-container"><input id="submit-form" type="submit" title="Envoi" name="submit"
                                              value="Générer">
        </section>
        <?php
        if (error())
            echo "<section id='help'>" . error() . "</section></form></section>";
        else {
            echo "</form></section>";
            echo "<section id='img-fractale'><img id='fractale' src='fractale.jpg'></section>";
            if ($_GET['iterations'] != "" && $_GET['degre'] != "")
                draw_fractal(0, 0, $_GET['iterations'], $_GET['degre']);
            else
                draw_fractal(0, 0, 50, 2);
        }
        ?>
</body>
</html>

