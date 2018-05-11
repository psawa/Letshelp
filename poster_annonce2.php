<?php 
$donnees['menu'] ='poster_annonce';
$donnees['titre_page']="Poster une annonce";
include 'entete.php'; ?>

<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0 AND isset($_GET['categorie']) AND isset($_GET['departement']) && $_GET['departement'] != '' && $_GET['categorie']!=''):?>

<?php 
	$requete_ville="SELECT ville.nom, ville.id FROM ville WHERE ville.id_departement = ? ORDER BY ville.nom ASC;";
	$reponse_ville=$pdo->prepare($requete_ville);
	$reponse_ville->execute(array($_GET['departement']));
	// récupérer tous les enregistrements dans un tableau 
	$enregistrements_ville = $reponse_ville->fetchAll(); 
?>

<div class="form">
	<form method="post" action="enregistrer_annonce.php">
		<input type="radio" name="type" id ="demande" value="0"> <label for="demande">Demande</label>
		<input type="radio" name="type" id="proposition" value="1"> <label for="proposition">Proposition</label> <br/>

		<label>Titre : </label>
		<input type="text" name="titre"> <br><br>
		<label>Description</label>
		<textarea name="description" cols="50" rows="8"></textarea><br/><br/>
		<label>ville</label>
		<select name="ville">
			<option  value="" selected disabled hidden>Ta ville</option>
			<?php 
				for($i=0; $i < count($enregistrements_ville) ; $i++){
					echo '<option value="'.$enregistrements_ville[$i]['id'].'">'.$enregistrements_ville[$i]['nom'].'</option>';
				} 
			?>

		</select>
		<br><br><br/>
		<input type="hidden" name="categorie" value="<?php echo $_GET['categorie']; ?>">
		<input type="submit" name="poster l'annonce">
	</form>
</div>

<?php else: ?>
<?php header("location:poster_annonce1.php"); ?>
<?php endif; ?>

<?php include 'pied.php'; ?>