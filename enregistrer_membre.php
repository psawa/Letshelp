<?php 
$donnees['menu']='';
$donnees['titre_page']="Inscription";
include 'entete.php'; ?>

	
	<?php 
	if($_POST['pseudo']!=''AND $_POST['email']!='' AND $_POST['motdepasse']!=''){ //on vériie que les champs sont remplis
		$motdepasse = $_POST['motdepasse'];
		$pseudo = $_POST['pseudo'];
		$email = $_POST['email'];
		//requete qui prend seulement le pseudo s'il existe
		$requete1 = "SELECT pseudo FROM membre WHERE pseudo = ?;";
		$reponse1 = $pdo->prepare($requete1);
		$reponse1 -> execute(array($pseudo));
		$enregistrements1 = $reponse1->fetchAll();
		$nombre_enregistrements1 = count($enregistrements1);
	}
	else{ ?>
		<p>Vous n'avez pas renseigné tous les champs. Veuillez recommencer.<p>
	<?php 
	}
	// Si le pseudo existe déjà
	if($nombre_enregistrements1>0){
		?>
		<p>Désolé ! ce pseudo est déjà utilisé.</p>
	<?php 
	}
	else{
		$requete2 = "INSERT INTO membre (pseudo, mot_de_passe, email) VALUES (?, md5(?), ?);";
		$reponse2 = $pdo->prepare($requete2);
		$reponse2->execute(array($pseudo, $motdepasse, $email)); ?>

		<p>Bravo, vous êtes bien inscrits. Vous pouvez maintenant vous <a href="connexion.php">connecter</a>.</p>
		<h2>Récap : </h2>
		<p>Votre pseudo : <?php echo $pseudo; ?> <br></p>
		<p>Votre email : <?php echo $email; ?> <br></p>
		<?php 
	}
		?>



<?php include 'pied.php'; ?>