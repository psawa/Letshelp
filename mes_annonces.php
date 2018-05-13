<?php
	$donnees['menu']='Mes annonces';
	$donnees['titre_page']='Mes annonces';
include 'entete.php'; ?>

<h1> Mes Annonces </h1>

<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>
<h3> Mes demandes d'aide </h3>
	<?php
	$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE membre.id=? ORDER BY annonce.date DESC;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_SESSION['membre_id']));
		$reponse->execute();
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll();
	?>

	<div class="toutemesdemandes">
		<?php 
		if(count($enregistrements)>0){
			for($i=0; $i < count($enregistrements) ; $i++){
				if($enregistrements[$i]['type']==0) {
					echo '<div class="annonces_demande">';
					echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
					echo '</div>';
				}
			}
		}
		else  {
			echo "Vous n'avez pas publié de Demandes";
			}
				
		
		?>
	</div>



<h3> Mes Propositions d'aide </h3>
	<?php
	$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE membre.id=? ORDER BY annonce.date DESC;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_SESSION['membre_id']));
		$reponse->execute();
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll();
	?>

	<div class="toutemesdemandes">
		<?php 
		if(count($enregistrements)>0){
			for($i=0; $i < count($enregistrements) ; $i++){
				if($enregistrements[$i]['type']==1) {
					echo '<div class="annonces_proposition">';
					echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
					echo '</div>';
				}
			}
		}
		else  {
			echo "Vous n'avez pas publié de Propositions";
			}
				
		
		?>
	</div>



	<?php
	}
	else{ ?>
		<p>Désolé, veuillez vous <a href="connexion.php">connecter</a> ou vous <a href="inscription.php">inscrire</a> si ce n'est pas fait.</p>
	<?php 
	} 
	?>	

<?php include 'pied.php'; ?>