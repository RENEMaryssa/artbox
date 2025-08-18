<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'header.php';
require 'bdd.php';
$bdd = connexion();

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if (empty($_GET['id'])) {
    header('Location: index.php');
    
}

$requete = $bdd->prepare('SELECT * FROM oeuvres WHERE id = ?');
$requete->execute([$_GET['id']]);
$oeuvre = $requete->fetch();

// Si aucune oeuvre trouvée, on redirige vers la page d'accueil
if (!$oeuvre) {
    header('Location: index.php');
    
}
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
            <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
