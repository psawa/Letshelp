<?php
	$donnees['menu']='inscription';
	$donnees['titre_page']='Inscription';
include 'entete.php'; ?>

<h1>Inscription</h1>
<br/>

<!-- Si l'utilisateur est déjà connecté (via un lien apr un exemple) -->
<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0): ?>
		<p>S'il te plaît, déconnecte-toi avant de t'inscrire. </p>
<!-- Sinon on affiche le formulaire -->	
<?php else: ?>
<div class="form">
	<form action="enregistrer_membre.php" method="post">
		<input type="text" name="pseudo" id="pseudo" placeholder="Ton pseudo" required> <br/>
		<input type="password" name="motdepasse" id="motdepasse" placeholder="Ton mot de passe" required><br/>
		<input type="password" name="motdepasse_confirm" id="motdepasse_confirm" placeholder="Confirme ton mot de passe" required> <br>
		<input type="email" name="email" id="email" placeholder="Ton email" required> <br>
		<input type="submit" name="S\'inscrire">
	</form>
</div>
<p>Stp, n'utilise pas un mot de passe habituel. Ce site est un projet universitaire</p>

<?php endif; ?>

<?php include 'pied.php'; ?>