<?php 
$donnees['menu'] ='';
$donnees['titre_page']='';
include 'entete.php'; ?>

<?php 
	//on vérifie que les champs ne sont pas vides
	if(isset($_POST['retard']) && $_POST['retard'] != '' && isset($_POST['situation']) && $_POST['situation'] != '' && isset($_POST['texte']) && $_POST['texte'] != ''){
		
		$retard = $_POST['retard'];
		$situation = $_POST['situation'];
		$texte = $_POST['texte'];

		$requete = "INSERT INTO excuse (texte, id_retard, id_situation, id_membre) VALUES (?,?,?,?);";
		$reponse = $pdo->prepare($requete);
		$reponse->execute(array($texte, $retard, $situation, $_SESSION['membre_id']));

		echo "Ton excuse a été proposée";
	}
?>


<?php include 'pied.php'; ?>