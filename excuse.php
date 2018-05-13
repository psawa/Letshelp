<?php 
$donnees['menu'] ='cpasmafaute';
$donnees['titre_page']=' Voir excuse ';
include 'entete.php'; ?>

<?php if(isset($_GET['retard']) && $_GET['retard'] != '' && isset($_GET['situation']) && $_GET['situation'] != '' && isset($_GET['type_personne']) && $_GET['type_personne'] != ''): ?>
	
	<?php 
	$requete="SELECT excuse.texte, type_personne.nom AS type, membre.pseudo, situation.nom, retard.temps FROM excuse, type_personne, membre, situation , retard WHERE excuse.id_retard = retard.id AND excuse.id_type_personne = type_personne.id AND excuse.id_membre = membre.id AND excuse.id_situation  = situation.id AND excuse.id_retard = ? AND excuse.id_situation = ? AND excuse.id_type_personne = ?;";
	$reponse=$pdo->prepare($requete);
	$reponse->execute(array($_GET['retard'], $_GET['situation'], $_GET['type_personne']));
	$enregistrements = $reponse->fetchAll();

	$choix = rand(0, count($enregistrements)-1);
	?>

 	<p>Excuse pour un.e <?php echo strtolower($enregistrements[$choix]['type']); ?>, à utiliser <?php echo strtolower($enregistrements[$choix]['nom']) ?> pour un retard de <?php echo $enregistrements[$choix]['temps'] ?> </p>
 	<?php echo $enregistrements[$choix]['texte']; ?>

<?php else: ?>

	<p>Tu n'as pas entré tous les paramètres..</p>

<?php endif; ?>

<?php include 'pied.php'; ?>