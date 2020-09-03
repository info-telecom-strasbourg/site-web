<!-- Display all the lessons -->

@extends('partials.pole-index', [
	'listTitle' => 'Liste des cours',
	'items' => $lessons,
	'pole' => $pole,
	'isCover' => 'true',
	'errorMessage' => "Aucun cours n'a été trouvé",
	'routeNameShow' => 'poles.cours.show',
	'routeNameComments' => 'comments.poles.pole.store'
])

@section('see-more-button')
    <!-- Button to see more -->
    @if (isset($lessons) && $lessons->count() > 6)
        @include('partials.voirplus', ['id' => 'cours', 'element' => 'element'])
    @endif
@endsection

@section('extra-button')
    @can('create', 'App\Cours')
        <div class="text-center" style="margin-top:25px; margin-bottom:25px;">
            <a class="btn btn-primary btn-rounded" href="/poles/cours/create">Créer un cours</a>
        </div>
    @endcan
@endsection
