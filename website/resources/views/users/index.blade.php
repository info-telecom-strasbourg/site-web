<!-- Display all the users -->

@extends('layouts.layout')

@section('title', 'Liste des membres')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Membres</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Membres
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

		@if(strtolower($search) == "chuck norris")
		<div style="margin: 30px auto; color: red; text-align:center;">
			Personne ne peut trouver Chuck Norris, c'est lui qui vous trouvera!
		</div>
		@else

		<!-- Number of members -->
		<p class="total-members">Membres : {{ $nbUsers }}</p>

		<div class="container pt-5">
			<div class="row">
				@if(isset($users))
				@php
				$bureaus = [];
				$respos = [];
				$membres = [];
				@endphp
				@forelse ($users as $user)
				@if ($user->role->poste == 'Bureau')
				@php $bureaus[] = $user; @endphp
				@elseif ($user->role->poste == 'Respo')
				@php $respos[] = $user; @endphp
				@elseif ($user->role->poste == 'Membre')
				@php $membres[] = $user; @endphp
				@endif

				@empty

				<!-- If no member -->
				<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
					Aucun membres n'a été trouvé
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				@endforelse

				<!-- Members of the "Bureau" -->
				@if ($bureaus)
				<h2 class="col-12 title-users">Bureau</h2>
				@foreach ($bureaus as $bureau)
				<div class="col-md-3 text-center user">
					<a href="/users/{{ $bureau->id }}" class="respo">
						<img class="profil-rounded" src="{{ asset('storage/' . $bureau->profil_picture) }}">
						<p id="nom">{{ $bureau->name }}</p>
						<p id="fonction">{{ $bureau->role->role }}</p>
					</a>
				</div>
				@endforeach
				@endif

				<!-- Responsables -->
				@if ($respos)
				<h2 class="col-12 title-users">Responsables</h2>
				@foreach ($respos as $respo)
				<div class="col-md-3 text-center user">
					<a href="/users/{{ $respo->id }}" class="respo">
						<img class="profil-rounded" src="{{ asset('storage/' . $respo->profil_picture) }}">
						<p id="nom">{{ $respo->name }}</p>
						<p id="fonction">{{ $respo->role->role }}</p>
					</a>
				</div>
				@endforeach
				@endif

				<!-- Members -->
				@if ($membres)
				<h2 class="col-12 title-users">Membres</h2>
				@foreach ($membres as $membre)
				<div class="col-md-3 text-center user">
					<a href="/users/{{ $membre->id }}" class="respo">
						<img class="profil-rounded" src="{{ asset('storage/' . $membre->profil_picture) }}">
						<p id="nom">{{ $membre->name }}</p>
						<p id="fonction">{{ $membre->role->role }}</p>
					</a>
				</div>
				@endforeach
				@endif

				<!-- If no member -->
				@else
				<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
					Aucun membre n'a été trouvé
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif

			</div>
		</div>
		@endif

	</div>
</div>

@endsection