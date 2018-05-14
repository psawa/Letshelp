<?php
	$donnees['menu']='inscription';
	$donnees['titre_page']='Inscription';
include 'entete.php'; ?>

<!-- Si l'utilisateur est déjà connecté (via un lien apr un exemple) -->
<?php if(isset($_SESSION['membre_id']) AND $_SESSION['membre_id']>0): ?>
		<p>S'il te plaît, déconnecte-toi avant de t'inscrire. </p>
<!-- Sinon on affiche le formulaire -->	
<?php else: ?>
<div class="form">
	<form action="enregistrer_membre.php" method="post">
		<label for="pseudo">pseudo : </label>
		<input type="text" name="pseudo" id="pseudo" required> <br>
		<label for="motdepasse">Mot de passe : </label>
		<input type="password" name="motdepasse" id="motdepasse" required> <br>
		<label for="email">Email : </label>
		<input type="email" name="email" id="email" required> <br>
		<input type="submit" name="S\'inscrire">
	</form>
</div>
<p>Stp, n'utilise pas un mot de passe habituel. Ce site est un projet universitaire</p>

<?php endif; ?>

<?php include 'pied.php'; ?>