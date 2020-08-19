@extends('partials.pole-index', [
	'listTitle' => 'Liste des compétitions', 
	'items' => $competitions,
	'pole' => $pole,
	'isCover' => 'true',
	'errorMessage' => "Aucune compétition n'a été trouvée",
	'routeNameShow' => 'poles.competitions.show',
	'routeNameComments' => 'comments.poles.pole.store'
])

@section('see-more-button')
	<!-- Button to see more -->
	@if(isset($competitions) && $competitions->count() > 6)
		@include('partials.voirplus', ['id' => 'compet', 'element' => 'element'])
	@endif
@endsection

@section('extra-button')
	@can ('create', 'App\Competition')
		<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
			<a class="btn btn-primary btn-rounded" href="/poles/competitions/create">Créer une compétition</a>
		</div>
	@endcan
@endsection