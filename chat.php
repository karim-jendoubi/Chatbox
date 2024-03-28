<?php
	// Initialiser la session
	session_start();

	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chatbox</title>
    <link rel="stylesheet" type="text/css" href="chat.css">
  </head>
  <body>
    <?php
    require('config.php');
    if (isset($_REQUEST['username'], $_REQUEST['messages'])){
      // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
      $username = stripslashes($_REQUEST['username']);
      $username = mysqli_real_escape_string($conn, $username); 
      // récupérer l'messages et supprimer les antislashes ajoutés par le formulaire
      $messages = stripslashes($_REQUEST['messages']);
      $messages = mysqli_real_escape_string($conn, $messages);
      //requéte SQL 
        $query = "INSERT into `messages` (username, messages)
                  VALUES ('$username', '$messages')";
      // Exécute la requête sur la base de données
        $res = mysqli_query($conn, $query);
    }
    ?>
    <header>
       <h1>chatbox</h1>
       <button class="deco"><a href="logout.php">Déconnexion</a></button>
    </header>
    <article>
      <?php
      $mysqli = new mysqli("localhost", "karim", "root", "snir");
      $mysqli->set_charset("utf8");
      $requete = "SELECT username, messages FROM messages";
      $resultat = $mysqli->query($requete);
      while ($ligne = $resultat->fetch_assoc()) {
        echo $ligne['username'] . ' ' . $ligne['messages'] . '<br>';
      }
      $mysqli->close();
      ?>
    </article>
    <footer>
    	<form action="" method="POST">
    		<input type="text" class="tchat" name="messages"placeholder="Envoyez un chat"  required />
            <label for="file"class="label-file">+</label>
		    <input id="file" type="file" name="doc" class="input-file" />
		    <input type="submit" name="submit" value='Envoyez'/>
    	</form>
    </footer>  
  </body>
</html>






