<?php 
$donnees['menu'] ='cpasmafaute';
$donnees['titre_page']="cpasmafaute";
include 'entete.php'; ?>

<?php
$requete_retard="SELECT retard.temps, retard.id FROM retard;";
$reponse_retard=$pdo->prepare($requete_retard);
$reponse_retard->execute();
$enregistrements_retard = $reponse_retard->fetchAll();
?>

<?php
$requete_situation="SELECT situation.nom, situation.id FROM situation;";
$reponse_situation=$pdo->prepare($requete_situation);
$reponse_situation->execute();
$enregistrements_situation = $reponse_situation->fetchAll();
?>

<?php
$requete_type_personne="SELECT type_personne.nom, type_personne.id FROM type_personne;";
$reponse_type_personne=$pdo->prepare($requete_type_personne);
$reponse_type_personne->execute();
$enregistrements_type_personne = $reponse_type_personne->fetchAll();
?>




<div class="cpasmafaute">
	<div class="generateur_excuse">
		<h2>Générateur d'excuses</h2>
		<form action="excuse.php" method="GET">
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
			for($i=0; $i < count($enregistrements_situation) ; $i++) { 
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
			<input type="submit"/>
		</form>
		<?php 
		$requete_nb="SELECT count(id) as nb_excuses FROM excuse;";
		$reponse_nb=$pdo->prepare($requete_nb);
		$reponse_nb->execute();
		$enregistrement_nb =  $reponse_nb->fetch();

		$nb_excuses = $enregistrement_nb['nb_excuses'];
		?>
		<p> <?php echo $nb_excuses; ?> excuses proposées.</p>
	</div>

<!-- =============================================== -->
		
	<div class="proposer_excuse">
		<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0): ?>
			<h2>Proposer une excuses</h2>
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
	 			 <option value="" selected disabled hidden>Pour...</option>
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
		<?php else: ?>
			<p> Tu dois être <a href="connexion.php"> connecté </a> pour proposer une excuse</p>
		<?php endif; ?>
	</div>

</div>

<?php
	if (isset($_SESSION['membre_id]) AND ($_SESSION['membre_id']==$enregistrements['id'])
	{
		?>
		<p><a href="supprimer_excuse.php?id=<?php echo S_GET['id']?>"> Supprimer cette excuse </a> <p>
		<?php
	}
	else 
	{ 
		?>
		<p>  <p>
		<?php
	}
	?>

<?php include 'pied.php'; ?>
