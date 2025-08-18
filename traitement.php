<?php
require 'bdd.php';
$bdd = connexion();

// Vérifier les champs
if (empty($_POST['titre'])
    || empty($_POST['artiste'])
    || empty($_POST['description'])
    || empty($_POST['image'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    
    header('Location: ajouter.php?erreur=true');
    
} else {
    // Sécuriser les données
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    // Insertion en base avec requête préparée
    $stmt = $bdd->prepare("INSERT INTO oeuvres (titre, artiste, description, image) VALUES (:titre, :artiste, :description, :image)");
    $stmt->execute([
        ':titre' => $titre,
        ':artiste' => $artiste,
        ':description' => $description,
        ':image' => $image
    ]);

    // Redirection après succès
    header('Location: index.php?success=1');
    
}
