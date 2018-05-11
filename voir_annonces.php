<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Voir les annonces";
include 'entete.php'; ?>

<?php 
	$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, membre.pseudo FROM annonce 
	INNER JOIN membre ON membre.id = annonce.id_membre;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute();
	// récupérer tous les enregistrements dans un tableau 
	$enregistrements = $reponse->fetchAll(); 
?>
<div class="toutelesannonces">
	<?php 
	for ($i=0; $i < count($enregistrements) ; $i++) { 
		echo '<div class="annonces">';
		echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
		echo '</div>';
	}
	?>
</div>

<?php include 'pied.php'; ?>