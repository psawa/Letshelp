<?php 
	$donnees['menu']='authentification';
	$donnees['titre_page']='authentification';
	include 'entete.php'; ?>

<?php 
	//on vérifie que les champz sont pas vides
	if($_POST['pseudo'] !='' and $_POST['motdepasse']!=''){
		$pseudo = $_POST['pseudo'];
		$motdepasse = $_POST['motdepasse'];
	}
	else{
		echo "Tu n'as pas remplit toutes les cases, petit.e tête en l'air ! ";
	}
	$requete = 'SELECT * FROM membre WHERE pseudo= ?;';
	$reponse = $pdo->prepare($requete);
	$reponse -> execute(array($_POST['pseudo']));

	$enregistrements = $reponse->fetchAll();

	$nombereponses = count($enregistrements);

	if($nombereponses>0){//on vérifie que le pseudo existe
		if($enregistrements[0]['mot_de_passe'] == md5($_POST['motdepasse'])){//on vérifie que le mdp est bon
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['membre_id'] = $enregistrements[0]['id'];
			$_SESSION['membre_email'] = $enregistrements[0]['email'];
			$_SESSION['admin'] = $enregistrements[0]['admin'];
			echo 'Bienvenue, '.$pseudo;
			header("location:index.php");

		}
		else{
			echo "Mauvais mot de passe, tu peux <a href='connexion.php'>réessayer</a>";
		}
	}
	else{
		echo "Ce pseudo n'existe pas, désolé.</a>";
	}
?>
<?php include'pied.php'; ?>
