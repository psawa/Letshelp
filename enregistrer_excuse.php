<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php 
	if(isset($_POST['retard']) && $_POST['retard'] != '' && isset($_POST['situation']) && $_POST['situation'] != '' && isset($_POST['type_personne']) && $_POST['type_personne'] != '' && isset($_POST['texte']) && $_POST['texte'] != ''){
		
		$retard = $_POST['retard'];
		$situation = $_POST['situation'];
		$type_personne = $_POST['type_personne'];
		$texte = $_POST['texte'];

		$requete = "INSERT INTO excuse (texte, id_retard, id_situation, id_type_personne, id_membre) VALUES (?,?,?,?,?);";
		$reponse = $pdo->prepare($requete);
		$reponse->execute(array($texte, $retard, $situation, $type_personne, $_SESSION['membre_id']));

		echo "Ton excuse a été proposée";
	}
?>


<?php include 'pied.php'; ?>