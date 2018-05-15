<?php 
$donnees['menu'] ='mon_compte';
$donnees['titre_page']='Mon compte';
include 'entete.php'; ?>


<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0): ?>

<h2> Modifier Mot de Passe </h2><br>


<?php 
	if(isset($_POST['nouveau_mdp'])): ?>
	<?php 

	$motdepasse_confirm = $_POST['motdepasse_confirm'];
	$nouveau_mdp = $_POST['nouveau_mdp'];

	$requete = 'SELECT * FROM membre WHERE pseudo= ?;';
	$reponse = $pdo->prepare($requete);
	$reponse -> execute(array($_SESSION['pseudo']));

	$enregistrements = $reponse->fetchAll();

	
		if($enregistrements[0]['mot_de_passe'] == md5($_POST['motdepasse'])){//on vérifie que le mdp est bon
			if($nouveau_mdp==$motdepasse_confirm){
			$requete="UPDATE membre SET mot_de_passe = md5(?) WHERE membre.id = ?;";
			$reponse=$pdo->prepare($requete);
			$reponse->execute(array($_POST['nouveau_mdp'],$_SESSION['membre_id']));
			$reponse->execute();
			echo "<p>Votre mot de passe a été modifié avec succès. Retour à <a href='index.php'>l'Accueil</a>.</p>";
			}
			else {
				echo "Les 2 mots de passe ne correspondent pas.";
			}
		}
		else {
			echo "L'ancien mot de passe saisi n'est pas le bon.";
		}
	
	?>


<?php else: ?>
<div class="form">
	<form action="modifier_mdp.php" method="post">
		<input type="password" name="motdepasse" id="motdepasse" placeholder="Ancien mot de passe" required><br/>
		<input type="password" name="nouveau_mdp" id="nouveau_mdp" placeholder="Ton mot de passe" required><br/>
		<input type="password" name="motdepasse_confirm" id="motdepasse_confirm" placeholder="Confirme ton mot de passe" required> <br>
		<input type="submit" name="Modifier">
	</form>
</div>

<?php endif; ?>
<?php else: ?>
	<p>Vous devez vous <a href="connexion.php">connecter</a> pour accéder à cette fonctionnalité. </p>
<?php endif; ?>



<?php include 'pied.php'; ?>