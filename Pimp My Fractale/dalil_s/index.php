<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pimp My Fractale</title>
    <link rel="stylesheet" href="index.css">
    <?php include 'fractale.php' ?>
</head>
<body id="html-body">
<section id="header">Pimp My Fractale</section>
<form id="calcul-form" action="#" method="post">
    <section id="form-title">Générez une fractale de l'ensemble de Mandelbrot</section>
    <section class="input-form">
        <section class="input-title">Nombre d'itération</section>
        <input class="input-number" type="number" title="Nombre d'itération" name="iterations" placeholder="50">
    </section>
    <section class="input-form">
        <section class="input-title">Degré</section>
        <input class="input-number" type="number" title="Degré" name="degre" placeholder="2">
    </section>
    <section id="submit-container"><input id="submit-form" type="submit" title="Envoi" name="submit" value="Générer">
    </section>
    <section id="help"><?php fractale($_POST) ?></section>
</form>
</body>
</html>
