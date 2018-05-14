<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php  // Fonction qui génère un mot de passe
function genere_password($size)
{
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

    $password = '';

    for($i=0;$i<$size;$i++)
    {
        $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return $password;
}
?>

<?php if(isset($_POST['code_confirm']) AND isset($_POST['mail'])){
	// Si c'est le bon code, Créer un nouveau mdp temporaire , update la bdd 
		$requete = "SELECT membre.mdp_temp FROM membre WHERE membre.email = ?  ";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_POST['mail']));
		$enregistrements = $reponse->fetch();
	 
	if(count($enregistrements)>0 AND $enregistrements['mdp_temp'] != NULL){ //Si le mdp temp existe bel et bien
		if($_POST['code_confirm']==$enregistrements['mdp_temp']){// Si le code de confirmation est correct

			$new_mdp = genere_password(10);

			//on crée un nouveau mot de passe aléatoire à l'utilisateur

			$requete="UPDATE membre SET mot_de_passe = ? WHERE membre.email = ?;";
			$reponse=$pdo->prepare($requete);
			$reponse->execute(array(md5($new_mdp),$_POST['mail']));
			$reponse->execute();

			//Et on supprime le mot de passe temporaire
			$requete="UPDATE membre SET mdp_temp = NULL WHERE membre.email = ?;";
			$reponse=$pdo->prepare($requete);
			$reponse->execute(array($_POST['mail']));
			$reponse->execute();

			//Et bien sur on envoie un mail avec le nouveau mdp

			$mailto = htmlentities($_POST['mail']);
			$sujet = 'Votre nouveau mot de passe';


			$headers = ("From: contact@letshelp.fr");
			$txt = "Voici votre nouveau mot de passe : \n\n".$new_mdp;

			mail($mailto, $sujet, $txt, $headers);

			echo "<p>Nous vous avons envoyé votre nouveau mot de passe. retour à l'<a href='index.php'>accueil</a></p>";
		}
		else{
			echo "<p>Mauvais code de confirmation</p> <br/>";
			echo "<p><a href='mdp_perdu.php'>Réessayer </a> </p>";
		}
	}
	else{
		echo "<p> L'utilisateur possédant cet email n'a pas demandé à réinitialiser son mot de passe. <p>";
	}
}






else{?>

	<form action="mdp_perdu.php" method="POST">
		<input type="text" name="code_confirm" placeholder="Code de confirmation">
		<input type="mail" name="mail" placeholder="Ton email">
		<input type="submit">
	</form>
<?php } ?>

<?php include 'pied.php'; ?>