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
<form id="calcul-form" action="index.php" method="post">
    <section class="form-title">Générez une fractale de l'ensemble de Mandelbrot</section>
    <section id="iteration">
        <section class="input-title">Nombre d'itérations</section>
        <input class="input-number" type="number" title="Nombre d'itération" name="iterations" placeholder="50">
    </section>
    <section id="degre">
        <section class="input-title">Degré</section>
        <input class="input-number" type="number" title="Degré" name="degre" placeholder="2">
    </section>
    <input type="submit" title="Envoi" value="Générer">
    <section id="help"><?php fractale($_POST) ?></section>
</form>
</body>
</html>
