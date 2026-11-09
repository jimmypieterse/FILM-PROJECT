<?php
require 'db.php';

$sql = "
SELECT
    f.film_id,
    f.filmnaam,
    f.genre,
    GROUP_CONCAT(a.acteurnaam SEPARATOR ', ') AS acteurs

FROM films f

LEFT JOIN film_acteur fa
    ON f.film_id = fa.film_id

LEFT JOIN acteurs a
    ON fa.acteur_id = a.acteur_id

GROUP BY
    f.film_id,
    f.filmnaam,
    f.genre

ORDER BY f.filmnaam
";

$resultaat = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Films en acteurs</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    background:#efefef;
}

/* HEADER */

header{
    display:flex;
    background:#1e88e5;
    height:90px;
}

.logo{
    width:100px;
    background:red;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:bold;
}

.menu{
    flex:1;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

.menu h2{
    color:white;
    margin-bottom:10px;
}

.menu a{
    color:white;
    text-decoration:none;
    margin:0 15px;
}

.menu a:hover{
    text-decoration:underline;
}

/* OVERZICHT */

.container{
    width:90%;
    margin:40px auto;
}

.rij{
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:15px;
}

.blok{
    background:#d3d3d3;
    width:250px;
    min-height:100px;

    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    padding:15px;
    text-align:center;
}

.titel{
    font-weight:bold;
    margin-bottom:10px;
}

/* Mobiel */

@media(max-width:850px){

    .rij{
        flex-direction:column;
        align-items:center;
    }

    .blok{
        width:90%;
    }

}

</style>
</head>

<body>

<header>

<div class="logo">
    LOGO
</div>

<div class="menu">

    <h2>Films en acteurs</h2>

    <div>
        <a href="index.php">Home</a>
        <a href="toevoegen.php">Film toevoegen</a>
        <a href="koppelen.php">Koppelen</a>
    </div>

</div>

</header>

<div class="container">

<?php while($row = $resultaat->fetch(PDO::FETCH_ASSOC)) { ?>

<div class="rij">

    <div class="blok">
        <div class="titel">FILM</div>

        <?= htmlspecialchars($row['filmnaam']); ?>
    </div>

    <div class="blok">
        <div class="titel">GENRE</div>

        <?= htmlspecialchars($row['genre']); ?>
    </div>

    <div class="blok">
        <div class="titel">ACTEURS</div>

        <?= !empty($row['acteurs'])
            ? htmlspecialchars($row['acteurs'])
            : 'Geen acteurs gekoppeld'; ?>
    </div>

</div>

<?php } ?>

</div>

</body>
</html>