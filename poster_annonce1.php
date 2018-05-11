<?php 
$donnees['menu'] ='poster_annonce';
$donnees['titre_page']="Poster une annonce";
include 'entete.php'; ?>

<?php 
	$requete_departement="SELECT departement.nom, departement.id FROM departement;";
	$reponse_departement=$pdo->prepare($requete_departement);
	$reponse_departement->execute();
	// récupérer tous les enregistrements dans un tableau 
	$enregistrements_departement = $reponse_departement->fetchAll(); 

	$requete_categorie="SELECT nom, id FROM categorie;";
	$reponse_categorie=$pdo->prepare($requete_categorie);
	$reponse_categorie->execute();
	// récupérer tous les enregistrements dans un tableau 
	$enregistrements_categorie = $reponse_categorie->fetchAll(); 
?>

<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0):?>

<div class="form">
	<form method="get" action="poster_annonce2.php">
		<label>Categorie</label>
		<select name="categorie">
 			 <option value="" selected disabled hidden>Ta catégorie</option>
				<?php 
					for ($i=0; $i < count($enregistrements_categorie) ; $i++) { 
						echo '<option value="'.$enregistrements_categorie[$i]['id'].'">'.$enregistrements_categorie[$i]['nom'].'</option>';
					}
			?>
		</select> <br/><br/>
		<label>departement</label>
		<select name="departement">
			<option  value="" selected disabled hidden>Ton département</option>
			<?php 
				for($i=0; $i < count($enregistrements_departement) ; $i++){
					echo '<option value="'.$enregistrements_departement[$i]['id'].'">'.$enregistrements_departement[$i]['id'].' - '.$enregistrements_departement[$i]['nom'].'</option>';
				} 
			?>

		</select>
		<br><br><br/>
		<input type="submit" value="Étape suivante">
	</form>
</div>

<?php else: ?>

<p>Tu dois te <a href="connexion.php">connecter</a> pour poster une annonce ! </p>

<?php endif; ?>

<?php include 'pied.php'; ?>