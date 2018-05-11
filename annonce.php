<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Voir les annonces";
include 'entete.php'; ?>

<?php if(isset($_GET['id'])): ?>
	<?php  
	$requete = "SELECT annonce.titre, annonce.description, annonce.date, membre.pseudo, categorie.nom FROM annonce, membre, categorie WHERE annonce.id_membre = membre.id AND annonce.id_categorie = categorie.id AND annonce.id=?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	$enregistrements = $reponse->fetch();

	$titre_annonce = $enregistrements['titre'];
	$description_annonce = $enregistrements['description'];
	$membre_pseudo = $enregistrements['pseudo'];
	$categorie = $enregistrements['nom'];
	?>
	<div class="annonce">
		<div class="annonce_corps">
			<div class="titre_annonce"><?php echo htmlentities($titre_annonce); ?></div>
			<div class="description_annonce"><?php echo htmlentities($description_annonce); ?></div>
		</div>
		<div class="annonce_membre_info"> 
			<?php echo htmlentities($membre_pseudo); ?><br/>
			<?php echo htmlentities($categorie) ?>
		</div>
	</div>

<?php endif; ?>

<?php include 'pied.php'; ?>