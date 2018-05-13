<?php 
$donnees['menu'] ='cpasmafaute';
$donnees['titre_page']="cpasmafaute";
include 'entete.php'; ?>

<?php
$requete_retard="SELECT retard.temps, retard.id FROM retard;";
$reponse_retard=$pdo->prepare($requete_retard);
$reponse_retard->execute();
$enregistrements_retard = $reponse_retard->fetchAll()
?>

<?php
$requete_situation="SELECT situation.nom, situation.id FROM situation;";
$reponse_situation=$pdo->prepare($requete_situation);
$reponse_situation->execute();
$enregistrements_situation = $reponse_situation->fetchAll()
?>

<?php
$requete_type_personne="SELECT type_personne.nom, type_personne.id FROM type_personne;";
$reponse_type_personne=$pdo->prepare($requete_type_personne);
$reponse_type_personne->execute();
$enregistrements_type_personne = $reponse_type_personne->fetchAll()
?>




<div class="cpasmafaute">
	<div class="generateur_excuse">
		<h2>Générateur d'excuses</h1>
	</div>



	<div class="proposer_excuse">
		<h2>Proposer une excuses</h1>
		<form action="enregistrer_excuse.php" method="POST">
			<!--RETARD -->
			<select name="retard">
 			 <option value="" selected disabled hidden>Temps de retard</option>
			<?php 
			for ($i=0; $i < count($enregistrements_retard) ; $i++) { 
				echo '<option value="'.$enregistrements_retard[$i]['id'].'">'.$enregistrements_retard[$i]['temps'].'</option>';
			}
			?>
			</select> 
			<br/><br/>

			<!--SITUATION -->
			<select name="situation">
 			 <option value="" selected disabled hidden>Situation</option>
			<?php 
			for ($i=0; $i < count($enregistrements_situation) ; $i++) { 
				echo '<option value="'.$enregistrements_situation[$i]['id'].'">'.$enregistrements_situation[$i]['nom'].'</option>';
			}
			?>
			</select> 
			<br/><br/>

			<!--type_personne -->
			<select name="type_personne">
 			 <option value="" selected disabled hidden>Vous êtes...</option>
			<?php 
			for ($i=0; $i < count($enregistrements_type_personne) ; $i++) { 
				echo '<option value="'.$enregistrements_type_personne[$i]['id'].'">'.$enregistrements_type_personne[$i]['nom'].'</option>';
			}
			?>
			</select> 
			<br/><br/>
			<label for="texte" >Ton excuse: </label>
			<textarea name="texte" id="texte" cols="50" rows="2" required> </textarea>
			<br/><br/>
			<input type="submit" value="Envoyer !">

		</form>

	</div>
</div>


<?php include 'pied.php'; ?>