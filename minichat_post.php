<?php
  // Connexion à la base de données
  include 'connect.php';

  $pseudo = $_POST['pseudo'];
  // Recherche du pseudo dans la table utilisateur pour avoir sont id
  $idPseudo = '';
  $req = $bdd->prepare('SELECT id FROM utilisateur WHERE pseudo = ?');
  $req->execute(array($pseudo));
  if($donnees = $req->fetch()) {
    $idPseudo = $donnees['id'];
  }
  else {
    // le pseudo n'a pas été trouvé dans la table utilisateur alors on l'ajout
    $req->closeCursor();

    $req = $bdd->prepare('INSERT INTO utilisateur (pseudo) VALUES(?)');
    $req->execute(array($pseudo));
    $idPseudo = $bdd->lastInsertId();
  }

  // Insertion du message à l'aide d'une requête préparée
  $req = $bdd->prepare('INSERT INTO minichat (id_pseudo, cree_le, message) VALUES(?, NOW(), ?)');
  $req->execute(array($idPseudo, $_POST['message']));

  // Redirection du visiteur vers la page du index.php
  header('Location: index.php');
?>