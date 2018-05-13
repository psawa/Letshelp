
<?php
	$donnees['menu']='Mes excuses';
	$donnees['titre_page']='Mes excuses';
include 'entete.php'; ?>

<h1> Mes Excuses </h1>


<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>

<?php
	$requete="SELECT excuse.texte, membre.pseudo, retard.temps, situation.nom, type_personne.nom AS type FROM excuse, membre, retard, situation, type_personne WHERE membre.id = excuse.id_membre AND retard.id = excuse.id_retard AND situation.id = excuse.id_situation AND type_personne.id = excuse.id_type_personne AND membre.id=?;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_SESSION['membre_id']));
		$reponse->execute();
		// récupérer tous les enregistrements dans un tableau 
		$enregistrements = $reponse->fetchAll();
	?>

<div class="toutemesexcuses">
	<table border="1px">
		<?php 
		if(count($enregistrements)>0){
			for($i=0; $i < count($enregistrements) ; $i++){
				echo "<tr>";
				echo "<td>".$enregistrements[$i]['temps']."</td>";
				echo "<td>".$enregistrements[$i]['nom']."</td>";
				echo "<td>".$enregistrements[$i]['type']."</td>";
				echo "<td>".$enregistrements[$i]['texte']."</td>";
				echo "</tr>";	
			}
		}
		?>
	</table>
</div>









<?php
}
?>

<?php include 'pied.php'; ?>