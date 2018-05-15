<?php 
$donnees['menu'] ='';
$donnees['titre_page']='Contact';
include 'entete.php'; ?>

<?php if(isset($_POST['id'])): ?>
	
	<h1>Contacter l'auteur de l'annonce</h1>
	<form action="envoi.php" method="POST">
		<input type="hidden" name="id" value="<?=$_POST['id']?>"/>
	    <input type="text" placeholder="Ton nom" name="nom"> <br/>
	    <input type="email" placeholder="Ton adresse mail" name="mailfrom" value="<?php if (isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0){ echo $_SESSION['membre_email'];} ?>"><br/>
	    <textarea name="message" type="text" placeholder="Ton message" cols="75" rows="15"></textarea> <br/>
	  	<input type="submit" value="Envoyer" name="submit">
	</form>

<?php else: ?>
	<p>Fatal error</p>

<?php endif; ?>


<?php include 'pied.php'; ?>