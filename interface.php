<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pimp My Fractale</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <script>
        window.onload = function () {
            var radio1 = document.getElementsByName("fractal-type")[0];
            var radio2 = document.getElementsByName("fractal-type")[1];

            radio1.onclick = hide;
            radio2.onclick = show;
        }
    </script>
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
        <section class="input-form">
            <label for="">Mandelbrot</label>
            <input id="mandelbrot" class="input-radio" type="radio" title="Type de fractale" name="fractal-type"
                   value="Mandelbrot" checked>
            <label for="julia">Julia</label>
            <input id="julia" class="input-radio" type="radio" title="Type de fractale" name="fractal-type"
                   value="Julia">
        </section>
        <section id="float" class="input-form">
            <section class="input-title">Partie réelle</section>
            <input class="input-number" type="text" title="Partie réelle" name="x" placeholder="0.5">
        </section>
        <section id="imaginary" class="input-form">
            <section class="input-title">Partie imaginaire</section>
            <input class="input-number" type="text" title="Partie imaginaire" name="y" placeholder="0.5">
        </section>
        <section id="submit-container"><input id="submit-form" type="submit" title="Envoi" name="submit"
                                              value="Générer">
        </section>
        <?php
        if (error())
            echo "<section id='help'>" . error() . "</section></form></section>";
        else {
            echo "</form></section><section id='img-fractale'><img id='fractale' src='fractale.jpg'></section>";
            if ($_GET['fractal-type'] == "Mandelbrot") {
                $iterations = $_GET['iterations'];
                $degre = $_GET['degre'];
                if ($iterations == "" || $degre == "") {
                    if ($iterations == "")
                        $iterations = 50;
                    if ($degre == "")
                        $degre = 2;
                }
                draw_mandelbrot((int)$iterations, (int)$degre);
            } else if ($_GET['fractal-type'] == "Julia") {
                $iterations = $_GET['iterations'];
                $degre = $_GET['degre'];
                $x = $_GET['x'];
                $y = $_GET['y'];
                if ($iterations == "" || $degre == "" || $x == "" || $y == "") {
                    if ($iterations == "")
                        $iterations = 50;
                    if ($degre == "")
                        $degre = 2;
                    if ($x == "")
                        $x = 0.5;
                    if ($y == "")
                        $y = 0.5;
                }
                draw_julia((float)$x, (float)$y, (int)$iterations, (int)$degre);
            }
        }
        ?>
</body>
</html>
