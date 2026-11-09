<?php

require 'db.php';

if(isset($_POST['film_opslaan']))
{
    $filmnaam = $_POST['filmnaam'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO films (filmnaam, genre)
            VALUES (:filmnaam, :genre)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':filmnaam' => $filmnaam,
        ':genre' => $genre
    ]);
}

if(isset($_POST['acteur_opslaan']))
{
    $acteurnaam = $_POST['acteurnaam'];

    $sql = "INSERT INTO acteurs (acteurnaam)
            VALUES (:acteurnaam)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':acteurnaam' => $acteurnaam
    ]);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Toevoegen</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>

<div class="logo">LOGO</div>

<nav>
<a href="index.php">Home</a>
<a href="overzicht.php">Films en acteurs</a>
<a href="koppelen.php">Koppelen</a>
</nav>

</header>

<div class="container">

<div class="formulier">

<h2>Film toevoegen</h2>

<form method="post">

<input type="text"
name="filmnaam"
placeholder="Filmnaam"
required>

<select name="genre">

<option value="Actie">Actie</option>
<option value="Drama">Drama</option>
<option value="Thriller">Thriller</option>
<option value="Komedie">Komedie</option>
<option value="Avontuur">Avontuur</option>


</select>

<button type="submit" name="film_opslaan">
Toevoegen
</button>

</form>

</div>

<div class="formulier">

<h2>Acteur toevoegen</h2>

<form method="post">

<input type="text"
name="acteurnaam"
placeholder="Acteurnaam"
required>

<button type="submit" name="acteur_opslaan">
Toevoegen
</button>

</form>

</div>

</div>

</body>
</html>