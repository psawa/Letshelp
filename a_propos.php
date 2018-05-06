<html lang="fr">

<?php 
$donnees['menu'] ='a_propos';
$donnees['titre_page']="A propos";
include 'entete.php'; ?>

<nav>
	<ul>
		<li><a href="#Concept">Concept de la page</a></li>
		<li><a href="#Contact">Contact</a></li>
	</ul>
</nav>

<article>
	<h2 id="Concept">Concept de la page</h2>

	<p> 
		"Let's Help, n'est-il pas temps de s'aider ?" est un projet universitaire crée par des étudiant-e-s.<br/>
		Le principe de ce site est de mettre en lien des personnes qui ont besoin d'aide et des gens qui veulent bien rendre services. <br/> 
		Pour poster une annonce, il vous suffit de donner un titre explicite à votre annonce, une description pour expliquer le type d'aide que vous recherchez, la catégorie, et dans quelle ville vous êtes. <br/>
		Pour voir les annonces, il vous suffit de remplir ... <br/>
		Cpasmafaute est une page où vous pouvez trouver des excuses en cas de retard, si vous ne voulez pas aller quelque part, ... et où vous pouvez déposer des excuses.
	</p>
</article>	
		
<article> 
	<h2 id="Contact">Contact</h2> 
	<p>les créateur-trice-s de cette page sont </p><span style="font-style : italic"> Annaelle Mounié </span>, <span style="font-style : italic"> Pauline Pasquiet </span> et <span style="font-style : italic"> Thibo Rosemplatt.</span> <br/>
	</article> 
		
		
<?php include 'pied.php'; ?>
