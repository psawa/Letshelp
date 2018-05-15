<?php 
$donnees['menu'] ='cpasmafaute';
$donnees['titre_page']=' Voir excuse ';
include 'entete.php'; ?>

<?php if(isset($_GET['retard']) && $_GET['retard'] != '' && isset($_GET['situation']) && $_GET['situation'] != ''): ?>
	
	<?php 
	$requete="SELECT excuse.texte, membre.pseudo, situation.nom, retard.temps FROM excuse, membre, situation , retard WHERE excuse.id_retard = retard.id AND excuse.id_membre = membre.id AND excuse.id_situation  = situation.id AND excuse.id_retard = ? AND excuse.id_situation = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['retard'], $_GET['situation']));
	$enregistrements = $reponse->fetchAll();

	?>


	<?php if(count($enregistrements)>0): ?>


		<?php $choix = rand(0, count($enregistrements)-1); ?>
		
		<?php $membre = $enregistrements[$choix]['pseudo']; ?>

	 	<p>Excuse à utiliser <?php echo strtolower($enregistrements[$choix]['nom']) ?> pour un retard de <?php echo $enregistrements[$choix]['temps']; ?> </p>
	 	<?php echo $enregistrements[$choix]['texte']; ?>

	 	<br/> <br/>
	 	<p>excuse proposée par <?php echo $membre; ?> </p>

	 <?php else: ?>


	 	<p>Pas encore d'excuses adaptées à cette situation, désolé ! see you soon.</p>


	 <?php endif; ?>

<?php else: ?>

	<p>Tu n'as pas entré tous les paramètres..</p>

<?php endif; ?>

<?php include 'pied.php'; ?>