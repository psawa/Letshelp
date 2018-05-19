<?php
	$donnees['menu']='Mes annonces';
	$donnees['titre_page']='Mes annonces';
include 'entete.php'; ?>

<h1> Mes Annonces </h1>
<br/>

<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>
	
<h3> Mes demandes d'aide </h3>
	<?php
	$requete_0="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, annonce.active, membre.pseudo FROM annonce
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE annonce.id_membre = ? AND annonce.type = 0 ORDER BY annonce.active DESC, annonce.date DESC;";
	$reponse_0=$pdo->prepare($requete_0);
	$reponse_0->execute(array($_SESSION['membre_id']));
	$reponse_0->execute();
	$enregistrements_0 = $reponse_0->fetchAll();
	?>

	<div class="toutemesdemandes">
		<?php 
		if(count($enregistrements_0)>0){
			for($i=0; $i < count($enregistrements_0) ; $i++){
				if($enregistrements_0[$i]['active']==1){
					echo '<a href="annonce.php?id='.$enregistrements_0[$i]['id'].'">';
					echo '<div class="annonce_demande">';
					echo htmlentities($enregistrements_0[$i]['titre']).', '.htmlentities($enregistrements_0[$i]['pseudo']).'<br/>';
					echo '</div>';
					echo '</a>';
				}
				elseif($enregistrements_0[$i]['active']==0){
					echo '<a href="annonce.php?id='.$enregistrements_0[$i]['id'].'">';
					echo '<div class="annonce_desactivee">';
					echo htmlentities($enregistrements_0[$i]['titre']).', '.htmlentities($enregistrements_0[$i]['pseudo']).'<br/>';
					echo '</div>';
					echo '</a> ';
				}
			}
		}
		else  {
			echo "<p>Vous n'avez pas publié de Demandes</p>";
			}
				
		
		?>
	</div>



<h3> Mes Propositions d'aide </h3>
	<?php
	$requete_1="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, annonce.active, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE annonce.id_membre = ? AND annonce.type = 1 ORDER BY annonce.active DESC, annonce.date DESC;";
	$reponse_1=$pdo->prepare($requete_1);
	$reponse_1->execute(array($_SESSION['membre_id']));
	$reponse_1->execute();
	$enregistrements_1 = $reponse_1->fetchAll();
	?>

	<div class="toutemesdemandes">
		<?php 
		if(count($enregistrements_1)>0){
			for($i=0; $i < count($enregistrements_1) ; $i++){
				if($enregistrements_1[$i]['active']==1) {
					echo '<a href="annonce.php?id='.$enregistrements_1[$i]['id'].'">';
					echo '<div class="annonce_proposition">';
					echo htmlentities($enregistrements_1[$i]['titre']).', '.htmlentities($enregistrements_1[$i]['pseudo']).'<br/>';
					echo '</div>';
					echo '</a>';
				}
				elseif($enregistrements_1[$i]['active']==0){
					echo '<a href="annonce.php?id='.$enregistrements_1[$i]['id'].'">';
					echo '<div class="annonce_desactivee">';
					echo htmlentities($enregistrements_1[$i]['titre']).', '.htmlentities($enregistrements_1[$i]['pseudo']).'<br/>';
					echo '</div>';
					echo '</a> ';
				}
			}
		}
		else  {
			echo "<p>Vous n'avez pas publié de Propositions</p>";
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