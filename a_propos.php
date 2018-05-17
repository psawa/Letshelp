<html lang="fr">

<?php 
$donnees['menu'] ='a_propos';
$donnees['titre_page']="A propos";
include 'entete.php'; ?>

<div>
	<ul>
		<li><a href="#Concept">Concept de la page</a></li>
		<li><a href="#Contact">Contact</a></li>
	</ul>
</div>

<article>
	<h2 id="Concept">Concept de la page</h2>
	<h3>Les annonces</h3>
	<p> 
		"Let's Help : n'est-il pas temps de s'aider ?" est un projet universitaire crée par des étudiant-e-s de deuxième année de licence.<br/>
		Le principe de ce site est de mettre en lien des personnes qui ont besoin d'aide et des qui acceptent de rendre service. <br/> 
		Vous pouvez poster deux types d'annonce : Les types dits "demande", dans lequel vous pouvez formuler une demande d'aide, et le type dit "proposition" dans lequel vous présentez une de vos compétences, que vous accepteriez de mettre en oeuvre pour d'autres.
		Pour poster une annonce, il vous suffit de lui donner un titre explicite, une description détaillée, sa catégorie, et dans la ville qui lui est associée. Le tout, respectant nos conditions d'utilisations, qui sont simplement du bon sens et du savoir vivre. (Celà me dédouane de les écrire) <br/>
		Pour voir les annonces, il faut se rendre dans l'onglet "voir annonces". Par défaut, seront affichées des annonces des deux types (explicités plus haut), mais d'une couleur distinctes. Vous pourrez par la suite filtrer les annonces par type et catégorie.<br/><br/>
		<h3>Cpasmafaute</h3>
		Cpasmafaute est l'outil qui fait la spécifité et l'originalité de notre site. A l'origine, nous étions partis pour créer un site web uniquement dédié à cet outil, mais pour satisfaire les envies de chacuns des créateur-ice-s nous avons ajouté la possibilité de s'entraider par les annonces, ce qui finalement est une grosse proportion du site .. ;) </br>
		Grâce à Cpasmafaute, vous pouvez demander des excuses adaptées à votre situation en cas de retard inexcusable. En effet, l'algorithme prend en paramètre votre votre statut (étudiant, prof, salarié..), votre temps de retard, la situation (travail, repas de famille, cours..) et vous propose une excuse adaptée. <br/>
		Afin de nourrir cet outil, vous avez en tant qu'utilisateur inscrit, la possibilité de proposer une excuse, testée ou non, en indiquant le contexte dans lequel elle pourrait être utilisée adéquatement. <br/>
		Lorsque vous avez utilisé une excuse, vous pourrez la retrouver dans votre compte, et ainsi la noter et la commenter une fois testée. Sympa non ? <br/>
		Allez, amuse toi ;)
		</p>
</article>	
		
<article> 
	<h2 id="Contact">Contact</h2> 
	<p>les créateur-trice-s de cette page sont </p><span style="font-style : italic"> Annaelle Mounié </span>, <span style="font-style : italic"> Pauline Pasquiet </span> et <span style="font-style : italic"> Thibo Rosemplatt.</span> <br/>
	</article> 
		
		
<?php include 'pied.php'; ?>
