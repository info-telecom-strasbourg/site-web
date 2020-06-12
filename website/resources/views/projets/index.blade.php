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
						<option disabled selected hidden>Pôle</option>
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

				@if(isset($projets))

					@forelse ($projets as $projet)
						<div class="col-md-3">
							<div class="card text-center rounded">
								<img class="card-img-top" src="/images/test.jpg" alt="Card image cap">
								<div class="card-body d-flex flex-column">
									<h5 class="card-title text-center font-weight-bold">
									</h5>
									<p class="card-text">
										<span>{{ mb_strlen( $projet->desc ) > 200 ? mb_substr($projet->desc, 0, 200) . ' ...' : $projet->desc }}
		                                </span>
									</p>
									<a href="/poles/{{ $projet->id }}" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
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

					<div class="row justify-content-center link-margin-top">
						<!-- Pagination links -->
						{{ $projets->links() }}
					</div>
				@else
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun projets n'a été trouvé
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