<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Voir les annonces";
include 'entete.php'; ?>

<?php if(isset($_GET['id'])): ?>
	<?php  
	$requete = "SELECT * FROM annonce WHERE id= ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	// récupérer tous les enregistrements dans un tableau 
	$enregistrements = $reponse->fetch();

	$titre_annonce = $enregistrements['titre'];
	$description_annonce = $enregistrements['description']
	?>
	<div class="titre_annonce"><?php echo $titre_annonce; ?></div>
	<div class="description_annonce"><?php echo $description_annonce; ?></div>

<?php endif; ?>

<?php include 'pied.php'; ?>