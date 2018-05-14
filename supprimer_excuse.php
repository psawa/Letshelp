<?php 
$donnees['menu'] ='voir_excuse';
$donnees['titre_page']="Supprimer excuse";
include 'entete.php'; ?> 


<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>
	<?php 
	$requete = "SELECT excuse.id_membre FROM excuse WHERE excuse.id=?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	$enregistrements = $reponse->fetch();
	$membre_id = $enregistrements['id_membre']
	?>


<?php if(isset($_GET['id'])AND $_SESSION['membre_id']==$membre_id){ ?>
	
	<?php 
	$requete="UPDATE excuse SET active = 0 WHERE excuse.id = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	$reponse->execute();
	?>
<?php 
}
else { ?>
<p> Erreur </p>
<?php
}
?>	

<?php 
$requete="SELECT active FROM excuse WHERE excuse.id=?;";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($_GET['id']));
$reponse->execute();
$enregistrements = $reponse->fetch();
$active = $enregistrements['active'];
?>

<?php if($active == 0)
echo "L'excuse a été supprimé avec succès";
?>



<?php
	}
	else{ ?>
		<p>Désolé, veuillez vous <a href="connexion.php">connecter</a> pour supprimer l'excuse. </p>
<?php 
	} 
?>


<?php include 'pied.php'; ?>
