<?php

require 'db.php';

if(isset($_POST['koppelen']))
{
    $film_id = $_POST['film_id'];
    $acteur_id = $_POST['acteur_id'];

    $controle = $pdo->prepare(
        "SELECT *
         FROM film_acteur
         WHERE film_id = ?
         AND acteur_id = ?"
    );

    $controle->execute([
        $film_id,
        $acteur_id
    ]);

    if($controle->rowCount() == 0)
    {
        $sql = $pdo->prepare(
            "INSERT INTO film_acteur
            (film_id, acteur_id)
            VALUES (?, ?)"
        );

        $sql->execute([
            $film_id,
            $acteur_id
        ]);

        $melding = "Koppeling opgeslagen.";
    }
    else
    {
        $melding = "Deze koppeling bestaat al.";
    }
}

$films = $pdo->query("
SELECT *
FROM films
ORDER BY filmnaam
");

$acteurs = $pdo->query("
SELECT *
FROM acteurs
ORDER BY acteurnaam
");

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Koppelen</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>

<div class="logo">LOGO</div>

<nav>
<a href="index.php">Home</a>
<a href="toevoegen.php">Toevoegen</a>
<a href="overzicht.php">Films en acteurs</a>
</nav>

</header>

<div class="formulier">

<h2>Koppelen</h2>

<?php
if(isset($melding))
{
    echo "<p>$melding</p>";
}
?>

<form method="post">

<select name="film_id">

<?php
while($film = $films->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?= $film['film_id']; ?>">
<?= $film['filmnaam']; ?>
</option>
<?php
}
?>

</select>

<br><br>

<select name="acteur_id">

<?php
while($acteur = $acteurs->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?= $acteur['acteur_id']; ?>">
<?= $acteur['acteurnaam']; ?>
</option>
<?php
}
?>

</select>

<br><br>

<button type="submit" name="koppelen">
Koppelen
</button>

</form>

</div>

</body>
</html>