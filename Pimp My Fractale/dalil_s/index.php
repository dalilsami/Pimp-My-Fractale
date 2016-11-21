<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pimp My Fractale</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div id="header">Pimp My Fractale</div>
<form action="index.php" method="post">
    <div class="form-title">Générez une fractale de l'ensemble de Mandelbrot</div>
    <div id="iteration">
        <label>Nombre d'itération</label>
        <input type="text" title="Nombre d'itération" placeholder="50">
    </div>
    <div id="degre">
        <label>Degré</label>
        <input type="text" title="Degré" placeholder="2">
    </div>
    <input type="submit" title="Envoi" value="Générer">
</form>
</body>
</html>