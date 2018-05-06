<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php 
if(isset($_POST['titre']) && $_POST['titre']!='' && isset($_POST['description']) && $_POST['description']!='' && isset( $_POST['categorie']) && $_POST['categorie']!='' && isset($_POST['ville']) && $_POST['ville']!=''){
	$titre=$_POST['titre'];
	$description=$_POST['description'];
	$id_categorie=$_POST['categorie'];
	$id_ville=$_POST['ville'];
	$id_membre=$_SESSION['membre_id'];

	$requete = "INSERT INTO annonce (titre, description, id_membre, id_categorie, id_ville) VALUES (?,?,?,?,?);";
	$reponse = $pdo->prepare($requete);
	$reponse->execute(array($titre, $description, $id_membre, $id_categorie, $id_ville));
	echo '<p>Votre annonce vient d\'être publiée !</p>';
}
else{
		echo'<p>Une erreur est survenue</p>';
}
?>




<?php include 'pied.php'; ?>