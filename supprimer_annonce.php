<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Supprimer annonce";
include 'entete.php'; ?> 

<!-- Si l'utilisateur est connecté -->
<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ ?>
	<?php 
	$requete = "SELECT annonce.id_membre FROM annonce WHERE annonce.id=?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	$enregistrements = $reponse->fetch();

	$membre_id = $enregistrements['id_membre'];

	?>

	<!-- On vérifie que le paramètre existe, et que l'utilisateur est bien le propriétaire de l'annonce -->
	<?php if(isset($_GET['id'])AND $_SESSION['membre_id']==$membre_id){ ?>
		<!-- Requete pour "supprimer" l'annonce (en vérité elle est juste désactivée) -->
		<?php 
		$requete="UPDATE annonce SET active = 0 WHERE annonce.id = ?;";
		$reponse=$pdo->prepare($requete);
		$reponse->execute(array($_GET['id']));
		$reponse->execute();
		?>
	<?php 
	}
	else{ ?>
	<p> Erreur </p>
	<?php
	}
	?>	
 
 <!-- Vérification que l'annonce a bien été supprimée -->
<?php 
$requete="SELECT active FROM annonce WHERE annonce.id=?;";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($_GET['id']));
$reponse->execute();
$enregistrements = $reponse->fetch();

$active = $enregistrements['active'];
?>

<?php if($active == 0)
echo "L'annonce a été supprimé avec succès";
?>



<?php
}
else{ ?>
	<p>Désolé, veuillez vous <a href="connexion.php">connecter</a> pour supprimer l'annonce. </p>
<?php 
} 
?>


<?php include 'pied.php'; ?>