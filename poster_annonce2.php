<?php 
$donnees['menu'] ='poster_annonce';
$donnees['titre_page']="Poster une annonce";
include 'entete.php'; ?>

<h1>Poster une annonce</h1>
<br/>

<!-- On vérifie que la personne est toujours connectée, et que le champs ne sont pas vides -->
<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0 AND isset($_GET['categorie']) AND isset($_GET['departement']) && $_GET['departement'] != '' && $_GET['categorie']!=''):?>

<!-- Requete permettant d'avoir la liste des villes correspondant au département sélectionné précedemment -->
<?php 
	$requete_ville="SELECT ville.nom, ville.id FROM ville WHERE ville.id_departement = ? ORDER BY ville.nom ASC;";
	$reponse_ville=$pdo->prepare($requete_ville);
	$reponse_ville->execute(array($_GET['departement']));
	$enregistrements_ville = $reponse_ville->fetchAll(); 
?>

<div class="form2">
	<form method="post" action="enregistrer_annonce.php">
		<input type="radio" name="type" id ="demande" value="0" required> <label for="demande">Demande</label>
		<input type="radio" name="type" id="proposition" value="1" required> <label for="proposition">Proposition</label> <br/>

		<input type="text" name="titre" required placeholder="Titre"> <br>
		<textarea name="description" cols="50" rows="8" required placeholder="Description"></textarea><br/>
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

<!-- Si l'utilisateur n'a pas rempli l'étape 1 correctement, il y est re-dirigé -->
<?php else: ?>
<?php header("location:poster_annonce1.php"); ?>
<?php endif; ?>

<?php include 'pied.php'; ?>