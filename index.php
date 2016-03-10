<?php
  // Connexion à la base de données
  include 'connect.php';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini-chat</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">Mini chat</h1>

      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Nouveau message</h3>
            </div>
            <div class="panel-body">
              <form action="minichat_post.php" method="post" class="form-horizontal">
                <div class="form-group">
                  <label for="pseudo" class="col-sm-5 control-label">Pseudo</label>
                  <div class="col-sm-7">
                    <input type="text" name="pseudo" id="pseudo" required="required" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="message" class="col-sm-5 control-label">Message</label>
                  <div class="col-sm-7">
                    <input type="text" name="message" id="message" required="required" />
                  </div>
                </div>
                <div class="text-center">
                  <input class="btn btn-success" type="submit" value="Envoyer" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Les 10 derniers messages</h3>
        </div>
        <div class="panel-body">
<?php
  // Récupération des 10 derniers messages
  $reponse = $bdd->query('SELECT U.pseudo, DATE_FORMAT(M.cree_le, \'%d/%m/%Y %H:%i:%s\') AS cree_le, M.message '.
                         'FROM minichat M '.
                         'INNER JOIN utilisateur U ON M.id_pseudo = U.id '.
                         'ORDER BY M.cree_le DESC '.
                         'LIMIT 0, 10');

  // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
  while ($donnees = $reponse->fetch()) {
    // je ne met pas la fonction htmlspecialchars pour la date parce que la date n'est pas reseigné par l'utilisateur
    echo '<p>' . $donnees['cree_le'] .' <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
  }

  $reponse->closeCursor();
?>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>