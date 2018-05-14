<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php 
if(isset($_POST['titre']) && $_POST['titre']!='' && isset($_POST['description']) && $_POST['description']!='' && isset( $_POST['categorie']) && $_POST['categorie']!='' && isset($_POST['ville']) && $_POST['ville']!='' && isset($_POST['type']) && $_POST['type']!=''){//on vérifie que les champs ne sont pas vides
	
	$titre=$_POST['titre'];
	$description=$_POST['description'];
	$id_categorie=$_POST['categorie'];
	$id_ville=$_POST['ville'];
	$id_membre=$_SESSION['membre_id'];
	$type = $_POST['type'];

	$requete = "INSERT INTO annonce (titre, description, id_membre, id_categorie, id_ville, type, date) VALUES (?,?,?,?,?,?,NOW());";
	$reponse = $pdo->prepare($requete);
	$reponse->execute(array($titre, $description, $id_membre, $id_categorie, $id_ville, $type));
	echo '<p>Votre annonce vient d\'être publiée !</p>';
}
else{
		echo'<p>Une erreur est survenue</p>';
}
?>




<?php include 'pied.php'; ?>