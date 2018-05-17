<?php 
$donnees['menu'] ='';
$donnees['titre_page']='Récupérer mon mot de passe';
include 'entete.php'; ?>

<?php

	$mailto = htmlentities($_POST['mail']);
	$sujet = 'Avez vous perdu votre mot de passe sur Let\'s Help ?';

	$mdp_temp = rand(0, 99999);

	$headers = ("From: contact@letshelp.fr");
	$txt = "Tu sembles avoir perdu ton mot de passe. \n \n Si c'est bien le cas, clique ici : https://pedagovic.uf-mi.u-bordeaux.fr/~trosemplatt/mdp_perdu.php \n\n
	Voici le code de confirmation dont tu auras besoin : ".$mdp_temp;

	mail($mailto, $sujet, $txt, $headers);

	echo '<p>Nous vous avons envoyé un email de confirmation</p><br/>';
	echo "<p>Attention, il se peut qu'il soit arrivé dans vos spams.</p>";

	$requete="UPDATE membre SET mdp_temp = ? WHERE membre.email = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($mdp_temp,$mailto));
	$reponse->execute(); 
?> 


<?php include 'pied.php'; ?>