<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Voir les annonces";
include 'entete.php'; ?>

<?php 
	$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
	INNER JOIN membre ON membre.id = annonce.id_membre ORDER BY annonce.date DESC;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute();
	// récupérer tous les enregistrements dans un tableau 
	$enregistrements = $reponse->fetchAll(); 
?>
<aside>
	<p>Propositions en rouge, demandes en bleu</p>
</aside>
<div class="toutelesannonces">
	<?php 
	for ($i=0; $i < count($enregistrements) ; $i++) {
		if($enregistrements[$i]['type']==0){
			echo '<div class="annonces_demande">';
			echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
			echo '</div>';
		}
		else{
			echo '<div class="annonces_proposition">';
			echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
			echo '</div>';
		}
		
	}
	?>
</div>

<?php include 'pied.php'; ?>