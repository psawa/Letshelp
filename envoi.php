<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php 

if(isset($_POST['submit'])){

	$requete = "SELECT membre.email FROM membre, annonce WHERE annonce.id_membre = membre.id AND annonce.id = ?;";
	$reponse = $pdo->prepare($requete);
	$reponse->execute(array($_POST['id']));
	$enregistrement = $reponse->fetch();

	$nom = $_POST['nom']; 
	$mailfrom = $_POST['mailfrom']; 
	$mailto = $enregistrement['email'] ;
	$message = $_POST['message']; 
	$sujet = 'Message concernant votre annonce sur Let\'s Help';


	$headers = ("From: ".$mailfrom);
	$txt = "Vous avez reçu un email de la part de ".$nom.".\n\n".$message;

	mail($mailto, $sujet, $txt, $headers);

	echo '<p>Votre message vient d\'être envoyé. Retour aux <a href="voir_annonces.php">annonces</a>.</p>';

}

?>



<?php include 'pied.php'; ?>