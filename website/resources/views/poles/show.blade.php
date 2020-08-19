<!-- Button to display a pole -->

@include('partials.pole-index', [
	'listTitle' => 'Nos ' . strtolower($pole->title), 
	'items' => $pole->projets,
	'pole' => $pole,
	'isCover' => 'false',
	'errorMessage' => "Aucun projet n'a été trouvée",
	'routeNameShow' => 'projets.show',
	'routeNameComments' => 'comments.poles.pole.store'
])



