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
		<div class="input-group md-form form-sm form-2 pl-0">
			<input class="form-control my-0 py-1 lime-border" type="text" placeholder="Rechercher" aria-label="Rechercher">
			<div class="input-group-append">
				<span class="input-group-text lime lighten-2" id="basic-text1">
					<i class="fas fa-search text-grey" aria-hidden="true">
					</i>
				</span>
			</div>
		</div>

    	<!-- Filter options -->
    	<div class="filter-options container">
    		<h2>Filtres</h2>
    		<div class="row">
    			<div class="col-md-3">
					<select class="form-control">
						<option disabled selected hidden>Rôle</option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control">
						<option disabled selected hidden>Membre</option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control">
						<option disabled selected hidden>Trié par</option>
					</select>
				</div>
				<div class="col-md-3 text-center">
					<button type="submit" class="btn btn-primary btn-primary btn-rounded">FILTRER</button>
				</div>
			</div>
		</div>

		<div class="container pt-5">
			<div class="row">

				@if(isset($users))

					@forelse ($users as $user)
						<div class="col-md-3 text-center">
							<a href="#" class="respo">
					            <img class="profil-rounded" src="images/defaut/profil.jpg">
					            <p id="nom"> Hugo Laullier </p>
					            <p id="fonction"> Président</p>
					        </a>
						</div>
				
					<!-- Pagination links -->
					{{ $users->links() }}
					
					@empty

						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucun membres n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>
					@endforelse

				@else
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun membres n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
					</div>
				@endif
			</div>
		</div>

    </div>
</div>

@endsection