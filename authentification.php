<?php 
	$donnees['menu']='authentification';
	$donnees['titre_page']='authentification';
	include 'entete.php'; ?>
<?php 
	if($_POST['pseudo'] !='' and $_POST['motdepasse']!=''){
		$pseudo = $_POST['pseudo'];
		$motdepasse = $_POST['motdepasse'];
	}
	else{
		echo "Tu n'as pas rempli toute les cases, petit.e tête en l'air ! ";
	}
	$requete = 'SELECT * FROM membre WHERE pseudo= ?;';
	$reponse = $pdo->prepare($requete);
	$reponse -> execute(array($_POST['pseudo']));

	$enregistrements = $reponse->fetchAll();

	$nombereponses = count($enregistrements);

	if($nombereponses>0){//on check que le pseudo existe
		if($enregistrements[0]['mot_de_passe'] == md5($_POST['motdepasse'])){//on check que le mdp est bon
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['membre_id'] = $enregistrements[0]['id'];
			echo 'Bienvenue, '.$pseudo;
			header("location:index.php");

		}
		else{
			echo "Non c'est pas le bon mot de passe, retourne à la <a href='index.php'>page d'accueil </a>";

		}
	}
	else{
		echo "Ce pseudo n'existe pas, désolé.</a>";
	}
?>
<?php include'pied.php'; ?>