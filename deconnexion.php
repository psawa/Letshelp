<?php 
$donnees['menu'] ='deconnexion';
$donnees['titre_page']="deconnexion";
include 'entete.php';
 ?>
 <?php
// $_SESSION['membre_id']=0;
// $_SESSION['pseudo']='';
$_SESSION = array(); // vide le tableau des sessions
 
session_destroy(); // détruit la session
 
header("location:index.php"); //si besoin, redirige vers une page spécifique
?>

<?php include 'pied.php'; ?>