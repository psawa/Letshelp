<?php 
$donnees['menu']='';
$donnees['titre_page']="Inscription";
include 'entete.php'; ?>

	
	<?php 
	if($_POST['pseudo']!=''AND $_POST['email']!='' AND $_POST['motdepasse']!='' AND $_POST['motdepasse_confirm'] != ''){ //on vériie que les champs sont remplis
		$motdepasse = $_POST['motdepasse'];
		$motdepasse_confirm = $_POST['motdepasse_confirm'];
		$pseudo = $_POST['pseudo'];
		$email = $_POST['email'];
		//requete qui prend seulement le pseudo s'il existe
		$requete1 = "SELECT pseudo FROM membre WHERE pseudo = ?;";
		$reponse1 = $pdo->prepare($requete1);
		$reponse1 -> execute(array($pseudo));
		$enregistrements1 = $reponse1->fetchAll();
		$nombre_enregistrements1 = count($enregistrements1);

		// requete qui prend l'email seulement s'il existe
		$requete2 = "SELECT email FROM membre WHERE email = ?;";
		$reponse2 = $pdo->prepare($requete2);
		$reponse2 -> execute(array($email));
		$enregistrements2 = $reponse2->fetchAll();
		$nombre_enregistrements2 = count($enregistrements2);
	}
	else{ ?>
		<p>Vous n'avez pas renseigné tous les champs. Veuillez recommencer.<p>
	<?php 
	}
	// Si le pseudo existe déjà
	if($nombre_enregistrements1>0){
		?>
		<p>Désolé ! ce pseudo est déjà utilisé.</p><br/>
		<p><a href="inscription.php">Réessayer</a></p>
	<?php 
	}
	elseif(count($enregistrements2)>0){?>
		<p>Désolé, cet email est déjà utilisé.</p><br/>
		<p><a href="inscription.php">Réessayer</a></p>
	<?php
	}
	else{
		if($motdepasse==$motdepasse_confirm){
			$requete2 = "INSERT INTO membre (pseudo, mot_de_passe, email) VALUES (?, md5(?), ?);";
			$reponse2 = $pdo->prepare($requete2);
			$reponse2->execute(array($pseudo, $motdepasse, $email)); ?>

			<p>Bravo, tu es bien inscrit. Nous t'avons envoyé tes informations par email. <br/> Tu peux maintenant te <a href="connexion.php">connecter</a>.</p>
			<h2>Récap : </h2>
			<p>Votre pseudo : <?php echo $pseudo; ?> <br></p>
			<p>Votre email : <?php echo $email; ?> <br></p>
			<?php 

			$mailto = $email;
			$sujet = "Confirmation d'inscription sur Let's Help";
			$txt = "Tu es bien inscrit sur Let's Help. \n\n Ton pseudo : ".$pseudo."\n Ton email : ".$email."\n\n À très bientôt ! ";
			$headers = ("From: contact@letshelp.fr ");

			mail($mailto,$sujet, $txt, $headers);
		}
		else{
			echo "<p>Vos mot de passes ne correspondent pas. Veuillez <a href='inscription.php'>réessayer</a>.</p>";
		}
	}
		?>



<?php include 'pied.php'; ?>