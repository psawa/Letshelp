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
<div class="page_annonces">
	<aside>
		<form method="get" action="voir_annonces.php">
			<label for="demande">
				<div class="annonces_demande">Demande</div>
			</label>
			<input type="checkbox" name="type" id ="demande" value="0"> 

			<label for="proposition">
				<div class="annonces_proposition">Proposition</div>
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
		?>
	</aside>


	<?php 
	//Si dans l'url sont spécifiés un type d'annonce ET une catégorie (envoyés par formulaire depuis la même page)
	if(isset($_GET['type']) && isset($_GET['cat'])){
		$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE annonce.type = ? AND annonce.id_categorie = ? AND annonce.active = 1 ORDER BY annonce.date DESC ;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_GET['type'],$_GET['cat']));
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll(); 
	}
	// Si dans l'url est spécifié seulement un type d'annonce (envoyé par formulaire depuis la même page)
	elseif(isset($_GET['type'])){
		$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE annonce.type = ? AND annonce.active = 1 ORDER BY annonce.date DESC ;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_GET['type']));
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll(); 
	}
	//Si dans l'url est spécifié seulement un id de catégorie (envoyé par formulaire depuis la même page)
	 
	elseif(isset($_GET['cat'])){
		$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE annonce.id_categorie = ? AND annonce.active = 1 ORDER BY annonce.date DESC ;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_GET['cat']));
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll(); 
	}
	//Si rien spécifié, on affiche tout
	else{
		$requete="SELECT annonce.titre, annonce.id, annonce.id_membre, annonce.type, membre.pseudo FROM annonce 
		INNER JOIN membre ON membre.id = annonce.id_membre WHERE annonce.active = 1 ORDER BY annonce.date DESC;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute();
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll(); 
	}
	?>

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
</div>
<?php include 'pied.php'; ?>