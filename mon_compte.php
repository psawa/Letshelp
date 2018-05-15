<?php 
$donnees['menu'] ='mon_compte';
$donnees['titre_page']='Mon compte';
include 'entete.php'; ?>

<h1>Mon compte</h1>

<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>
		<ul>
			<li>Mon pseudo :</li><br>
			<li>Mon email : </li><br>
			<li>Mon avatar : </li><br>
			<li>Modifier mon mot de passe</li><br>
	<?php
	}
	else{ ?>
		<p>Désolé, veuillez vous <a href="connexion.php">connecter</a> ou vous <a href="inscription.php">inscrire</a> si ce n'est pas fait.</p>
	<?php 
	} 
	?>	



<?php include 'pied.php'; ?>