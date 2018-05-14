<?php 
$donnees['menu'] ='mon_compte';
$donnees['titre_page']='Mon compte';
include 'entete.php'; ?>

<h1>Mon compte</h1>

<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>
	<?php 
	$requete = "SELECT membre.pseudo, membre.email, membre.image FROM membre WHERE membre.id = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_SESSION['membre_id']));
	$enregistrements = $reponse->fetch();

	$membre_pseudo = $enregistrements['pseudo'];
	$membre_email = $enregistrements['email'];
	$membre_image =$enregistrements['image'];

	?>

		<ul>
			<li>Mon pseudo : <?php echo $membre_pseudo ?></li><br>
			<li>Mon email : <?php echo $membre_email ?></li><br>
			<li>Mon avatar : <?php echo $membre_image ?></li><br>
			<li>Modifier mon mot de passe</li><br>
	<?php
	}
	else{ ?>
		<p>Désolé, veuillez vous <a href="connexion.php">connecter</a> ou vous <a href="inscription.php">inscrire</a> si ce n'est pas fait.</p>
	<?php 
	} 
	?>	



<?php include 'pied.php'; ?>