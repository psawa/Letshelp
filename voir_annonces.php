<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Voir les annonces";
include 'entete.php'; ?>

<?php 
//Requete pour afficher les catégories dans les filtres
	$requete_categorie="SELECT nom, id FROM categorie;";
	$reponse_categorie=$pdo->prepare($requete_categorie);
	$reponse_categorie->execute();
	$enregistrements_categorie = $reponse_categorie->fetchAll();
?>

<?php
//Requete pour afficher les départements dans les filtres
	$requete_departement="SELECT nom, id FROM departement;";
	$reponse_departement=$pdo->prepare($requete_departement);
	$reponse_departement->execute();
	$enregistrements_departement = $reponse_departement->fetchAll();
?>

<div class="page_annonces">
	<!-- Le formulaire qui fait office de "filtre" -->
	<aside>
		<form method="get" action="voir_annonces.php">
			<label for="demande">
				<div class="annonce_demande">Demande</div>
			</label>
			<input type="checkbox" name="type" id ="demande" value="0"> 

			<label for="proposition">
				<div class="annonce_proposition">Proposition</div>
			</label>
			<input type="checkbox" name="type" id="proposition" value="1">
			<br/><br/>
			<label for="cat">categorie</label>
			<select name="cat">
 				<option value="" selected disabled hidden>Catégories</option>
				<?php 
					for ($i=0; $i < count($enregistrements_categorie) ; $i++) { 
						echo '<option value="'.$enregistrements_categorie[$i]['id'].'">'.$enregistrements_categorie[$i]['nom'].'</option>';
					}
				?>
			</select>

			<label for="departement">Departement</label>
			<select name="departement">
				<option value="" selected disabled hidden>Départements</option>
				<?php 
					for ($i=0; $i < count($enregistrements_departement) ; $i++) { 
						echo '<option value="'.$enregistrements_departement[$i]['id'].'">'.$enregistrements_departement[$i]['id']." - ".$enregistrements_departement[$i]['nom'].'</option>';
					}
				?>
			</select>


		<input type="submit" value="Filtrer">
		</form>
		<p>Filtres actifs : </p>
		<?php 
		if(isset($_GET['cat'])){
			echo $enregistrements_categorie[$_GET['cat']-1]['nom']."<br/>";
		}
		
		if(isset($_GET['type']) && $_GET['type']==0){
			echo "Demande <br/>";
		}
		if(isset($_GET['type']) &&$_GET['type']==1){
			echo "Proposition <br/>";
		}
		if(isset($_GET['departement'])){
			echo $enregistrements_departement[$_GET['departement']-1]['nom']."<br/>";
		}
		?>
	</aside>


	<?php 
	$filtre='';
	if(isset($_GET['type'])){
		$filtre='AND annonce.type = '.$_GET['type'];
		}
		 
	if(isset($_GET['cat'])){
		$filtre=$filtre.' AND annonce.id_categorie = '.$_GET['cat'];
		}

	if(isset($_GET['departement'])){
		$filtre=$filtre.' AND ville.id_departement = '.$_GET['departement'];
		}


	$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo, ville.id_departement FROM annonce 
	INNER JOIN membre ON membre.id = annonce.id_membre INNER JOIN ville ON annonce.id_ville = ville.id WHERE annonce.active = 1 ".$filtre." ORDER BY annonce.date DESC;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute();
	$enregistrements = $reponse->fetchAll(); 
	?>


	<div class="toutelesannonces">
		<?php 
		if(count($enregistrements)>0){
			for ($i=0; $i < count($enregistrements) ; $i++) {
				// Si l'annonce est de type 0(demande), on lui affecte la classe "annonce_demande"
				if($enregistrements[$i]['type']==0){
					echo '<div class="annonce_demande">';
					echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
					echo '</div>';
				}
				// sinon, elle a la classe "annonce_proposition"
				else{
					echo '<div class="annonce_proposition">';
					echo '<a href="annonce.php?id='.$enregistrements[$i]['id'].'">'.htmlentities($enregistrements[$i]['titre']).'</a>, '.htmlentities($enregistrements[$i]['pseudo']).'<br/>';
					echo '</div>';
				}
			}
		}
		else{
			echo "Il n'y a pas d'annonce correspondant à ces critères";
		}
		?>
	</div>
</div>
<?php include 'pied.php'; ?>