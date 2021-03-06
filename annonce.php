<?php 
$donnees['menu'] ='voir_annonces';
$donnees['titre_page']="Voir les annonces";
include 'entete.php'; ?>
 

<!-- Si il ya un id dans l'url, on affiche l'annonce correspondante  --> 
<?php if(isset($_GET['id'])): ?>
	<?php  
	$requete = "SELECT annonce.titre, annonce.description, annonce.date, annonce.type, annonce.nb_message, annonce.active, annonce.vue, ville.id_departement, membre.pseudo, membre.id, categorie.nom,ville.nom as ville FROM annonce, membre, categorie, ville WHERE annonce.id_membre = membre.id AND annonce.id_categorie = categorie.id AND annonce.id_ville = ville.id AND annonce.id=?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	$enregistrements = $reponse->fetch();

	$titre_annonce = $enregistrements['titre'];
	$description_annonce = $enregistrements['description'];
	$membre_pseudo = $enregistrements['pseudo'];
	$categorie = $enregistrements['nom'];
	$date=$enregistrements['date'];
	$ville = $enregistrements['ville'];
	$nb_message = $enregistrements['nb_message'];
	$nb_vue = $enregistrements['vue'];
	$num_departement = $enregistrements['id_departement'];
	?>

	<?php 
	//On incrémente le compteur de vues 
	$requete="UPDATE annonce SET vue = vue + 1 WHERE annonce.id = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['id']));
	?>

	<div class="annonce">
		<div class="annonce_corps">
			<!-- Si l'annonce est de type "demande", on l'affiche en bleu -->
			<?php if($enregistrements['type']==0) {?>
				<div class="titre_annonce_0"><?php echo htmlentities($titre_annonce); ?></div>
				<div class="description_annonce_0"><?php echo htmlentities($description_annonce); ?></div>
			<?php
			}
			else{?>
			<!-- Si l'annonce est de type "proposition", on l'affiche en rouge -->
				<div class="titre_annonce_1"><?php echo htmlentities($titre_annonce); ?></div>
				<div class="description_annonce_1"><?php echo htmlentities($description_annonce); ?></div>
			<?php } ?>	
		</div>
		<div class="annonce_membre_info"> 
			<?= htmlentities($membre_pseudo); ?><br/>
			<?= htmlentities($ville)." (".htmlentities($num_departement).")"; ?> <br/> <br/>
			<?= htmlentities($categorie); ?> <br/> <br/>
			<?= htmlentities($date); ?><br/><br/>
			<?php if($enregistrements['active']==1){?>
				<form action="contact.php" method="post">
					<input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
					<input type="submit" value="contacter">
				</form>
			<?php
			}
			else{
			?>
				<p>l'annonce a été supprimmée, impossible d'en contacter l'auteur</p>
			<?php 
			} 
			?>
			<?= $nb_message." message(s)"; ?><br/><br/>
			<?= $nb_vue." vue(s)"; ?>
		</div>
	</div>

<?php endif; ?>

<!-- Pour afficher un bouton 'supprimer' SI on est l'auteur de l'annonce -->
<?php 
	if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']==$enregistrements['id'] AND $enregistrements['active']==1){ ?>
		<p><a href="supprimer_annonce.php?id=<?php echo $_GET['id'] ?>"> Supprimer votre annonce </a></p>
	<?php
	}
	elseif($enregistrements['active'] ==0 ){ ?>
	<p> Annonce supprimée </p>
	<?php 
	} 
	?>	

<?php include 'pied.php'; ?>