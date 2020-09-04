<!-- Display all the projects -->

@extends('layouts.layout')

@section('title', 'Projets')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Projets</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Projets
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<!-- Search bar -->
		<form>
			<div class="input-group md-form form-sm form-2 pl-0">
				<input class="form-control my-0 py-1 lime-border" type="search" name="search" id="search" placeholder="Rechercher" aria-label="Rechercher" value="{{ $search }}">
				<button class="input-group-append input-group-text lime lighten-2 btn btn-search" type="submit">
					<i class="fas fa-search text-grey" aria-hidden="true"></i>
				</button>
			</div>
		</form>

		<!-- Filter options -->
		<form class="filter-options container">
			<h2>Filtres</h2>
			<div class="row">
				<div class="col-md-3">
					<select class="form-control" name="pole" id="pole">
						<option readonly selected hidden value="">Pôles</option>

						@isset($poles)
						@foreach ($poles as $pole)
						<option value="{{ $pole->id }}" @if ($filters[0]==($pole->id)) selected @endif>{{ $pole->title }} </option>
						@endforeach

						<option value="" name="reset">Réinitialiser</option>
						@endisset
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="membre" id="membre">
						<option readonly selected hidden value="">Participants</option>

						@isset($participants)
						@foreach ($participants as $participant)
						<option value="{{ $participant->id }}" @if ($filters[1]==($participant->id)) selected @endif>{{ $participant->name }}</option>
						@endforeach

						<option value="" name="reset">Réinitialiser</option>
						@endisset
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="partner" id="partner">
						<option readonly selected hidden value="">Collaborateurs</option>

						@isset($partners)
						@foreach ($partners as $partner)
						<option value="{{ $partner->id }}" @if ($filters[2]==($partner->id)) selected @endif>{{ $partner->name }}</option>
						@endforeach

						<option value="" name="reset">Réinitialiser</option>
						@endisset
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="trie" id="trie">
						<option readonly selected hidden value="">Trier par</option>

						<option value="1" @if ($filters[3]==1) selected @endif>Ordre alphabétique</option>
						<option value="2" @if ($filters[3]==2) selected @endif>Ordre alphabétique inverse</option>
						<option value="3" @if ($filters[3]==3) selected @endif>Date de création</option>
						<option value="4" @if ($filters[3]==3) selected @endif>Date de création inverse</option>

						<option value="" name="reset">Réinitialiser</option>
					</select>
				</div>
				<div class="col-md-3 text-center">
					<button type="submit" class="btn btn-primary btn-primary btn-rounded">FILTRER</button>
				</div>
				<div class="col-md-3 text-center" style="opacity: .75;">
					<a href="/projets" class="btn btn-primary btn-primary btn-rounded w-100">RÉINITIALISER</a>
				</div>
			</div>
		</form>

		<!-- Display projects -->
		<div class="container pt-5">
			@include('partials.list-cards', ['items' => $projets, 'errorMessage' => "Aucun projet n'a été trouvée", 'routeNameShow' => 'projets.show'])

			<div class="row justify-content-center link-margin-top">
				<!-- Pagination links -->
				{{ $projets->links() }}
			</div>
			
			@can ('create', 'App\Projet')
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/projets/create'">Créer un projet</button>
			</div>
			@endcan
		</div>

	</div>
</div>

@endsection
