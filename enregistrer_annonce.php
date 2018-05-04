<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php 
	echo $_POST['titre'].'<br>';
	echo $_POST['description'].'<br>';
	echo $_POST['categorie'].'<br>';
	echo $_POST['departement'].'<br>';
	if($_POST['titre']!='' AND $_POST['description']!='' AND $_POST['categorie']!='' AND $_POST['departement']!=''):

		$titre=$_POST['titre'];
		$description=$_POST['description'];
		$id_categorie=$_POST['categorie'];
		$id_departement=$_POST['departement'];

		// $requete1="SELECT departement_nom FROM departement WHERE id =".$id_departement.";";
		// $reponse1=$pdo->prepare($requete1);
		// $reponse1->execute();
		// $departement = $requete1->fetch();

		// $requete2="SELECT nom FROM categorie WHERE id =".$id_categorie.";";
		// $reponse2=$pdo->prepare($requete2);
		// $reponse2->execute();
		// $categorie = $requete2->fetch();


		$requete = "INSERT INTO annonce (titre,description, id_categorie_annonce, id_departement) VALUES (?,?,?,?);";
		$reponse = $pdo->prepare($requete);
		$reponse->execute(array($titre, $description, $id_categorie,$id_departement));
		?>
	<p>Votre annonce vient d'être publiée !</p>
<?php else: ?>
		<p>Une erreur est survenue</p>
<?php endif; ?>




<?php include 'pied.php'; ?>