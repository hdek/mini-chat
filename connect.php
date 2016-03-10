<?php
  // Connexion à la base de données
  $base = 'mini-chat';
  $user = 'test';
  $password = 'test';

  try {
    $bdd = new PDO('mysql:host=localhost;dbname=' . $base . ';charset=utf8', $user, $password);
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
?>