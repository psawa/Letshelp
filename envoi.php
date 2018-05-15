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

	$requete2 = "SELECT annonce.titre FROM annonce WHERE annonce.id = ?;";
	$reponse2 = $pdo->prepare($requete2);
	$reponse2->execute(array($_POST['id']));
	$enregistrement2 = $reponse2->fetch();

	$nom = $_POST['nom']; 
	$mailfrom = htmlentities($_POST['mailfrom']); 
	$mailto = htmlentities($enregistrement['email']); //comme on a pas vérifié a variable email dans enregistrer membre (difficile) on sécurise tout de même ici
	$message = $_POST['message']; 
	$sujet = 'Message concernant votre annonce "'.$enregistrement2['titre'].' " sur Let\'s Help';


	$headers = ("From: ".$mailfrom);
	$txt = "Vous avez reçu un email de la part de ".$nom.".\n\n".$message;

	mail($mailto, $sujet, $txt, $headers);

	echo '<p>Votre message vient d\'être envoyé. Retour aux <a href="voir_annonces.php">annonces</a>.</p>';

	//On augmente le compteur de messages qui s'afiche dans annonce.php
	$requete="UPDATE annonce SET nb_message = nb_message + 1 WHERE annonce.id = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_POST['id']));

}
else{
	echo "<p>Erreur fatale, le site va exploser</p>";
}
?>



<?php include 'pied.php'; ?>