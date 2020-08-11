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
						<option readonly selected hidden value="">Pôle</option>

						@isset($poles)
							@foreach ($poles as $key => $pole)
								<option value="{{ $key + 1 }}" @if ($filters[0] == ($key + 1)) selected @endif>{{ $pole->title }} </option>
							@endforeach

							<option value="" name="reset">Reset</option>
						@endisset
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="membre" id="membre">
						<option readonly selected hidden value="">Membre</option>

						@isset($participants)
							@foreach ($participants as $key => $participant)
								<option value="{{ $key + 1 }}" @if ($filters[1] == ($key + 1)) selected @endif>{{ $participant->name }}</option>
							@endforeach

							<option value="" name="reset">Reset</option>
						@endisset
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="partner" id="partner">
						<option readonly selected hidden value="">Collaborateurs</option>

						@isset($partners)
							@foreach ($partners as $key => $partner)
								<option value="{{ $key + 1 }}" @if ($filters[2] == ($key + 1)) selected @endif>{{ $partner->name }}</option>
							@endforeach

							<option value="" name="reset">Reset</option>
						@endisset
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="trie" id="trie">
						<option readonly selected hidden value="">Triés par</option>

						<option value="1" @if ($filters[3] == 1) selected @endif>Ordre alphabétique</option>
	                    <option value="2" @if ($filters[3] == 2) selected @endif>Ordre alphabétique inverse</option>
	                    <option value="3" @if ($filters[3] == 3) selected @endif>Date de création</option>
	                    <option value="4" @if ($filters[3] == 3) selected @endif>Date de création inverse</option>

	                    <option value="" name="reset">Reset</option>
					</select>
				</div>
				<div class="col-md-3 text-center">
					<button type="submit" class="btn btn-primary btn-primary btn-rounded">FILTRER</button>
				</div>
				<div class="col-md-3 text-center" style="opacity: .75;">
					<a href="/projets" class="btn btn-primary btn-primary btn-rounded">RESET</a>
				</div>
			</div>
		</form>

		<div class="container pt-5">
			<div class="row justify-content-center">

				@if(isset($projets))

					@forelse ($projets as $projet)
						<div class="col-md sep-items" id="projets-container">
							<div class="card text-center rounded">
								<img class="card-img-top" src="{{ asset('storage/' . json_decode($projet->images)[0]) }}" alt="Card image cap">
								<div class="card-body d-flex flex-column">
									<h5 class="card-title text-center font-weight-bold">
										{{ $projet->title }}
									</h5>
									<p class="card-text">
										<span>{{ mb_strlen( $projet->desc ) > 57 ? mb_substr($projet->desc, 0, 54) . ' ...' : $projet->desc }}
		                                </span>
									</p>
									<a href="/projets/{{ $projet->id }}" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
								</div>
						  	</div>
						</div>

					@empty

						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucun projets n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>
					@endforelse

				@else
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun projets n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
					</div>
				@endif
			</div>
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
