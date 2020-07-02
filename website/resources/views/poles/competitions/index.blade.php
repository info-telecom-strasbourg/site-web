@extends('layouts.layout')

@section('title', 'Pôle' . $pole->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Pôle {{ $pole->title }}</li>
@endsection

@section('content')
<div class="container">
    <h1 class="title lg text-center">
        Pôle {{ $pole->title }}
    </h1>
    <hr class="line-under-title">

	<div class="container pt-3">
        <p>{{ $pole->desc }}</p>
        <h4 class="title md text-left">Liste des compétitions</h4>
		<div class="container pt-5">
			<div class="row justify-content-center">

				@if(isset($compets))
					@forelse ($compets as $compet)

						<div id="proj-card" class="col-md-auto sep-items">
							<div class="card text-center rounded">
								<img class="card-img-top" src="{{ asset('storage/' . json_decode($compet->image)[0]) }}" alt="Card image cap">
								<div class="card-body d-flex flex-column">
									<h5 class="card-title text-center font-weight-bold">
										{{ $compet->title }}
									</h5>
									<p class="card-text">
										<span>{{ mb_strlen( $compet->desc ) > 57 ? mb_substr($compet->desc, 0, 54) . ' ...' : $compet->desc }}
		                                </span>
									</p>
									<a href="/poles/competitions/{{ $compet->id }}" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
								</div>
						  	</div>
						</div>
					@empty

						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucune compétition n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>
					@endforelse

				@else
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun compétition n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
					</div>

				@endif
			</div>
		</div>

		<!-- Button to see more -->
		@if(isset($compets) && $compets->count() > 6)
	        <div id="line-btn-vp" class="d-flex justify-content-center">
	          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
	          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
	          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
	        </div>
		@endif

		<!-- Responsable -->
		<h4 class="title md text-left respo">Responsable {{ strtolower($pole->title) }}</h4>
		<div class="container pt-5" style="padding-top: 1rem !important; margin-bottom: -35px;">
			<div class="row align-items-center">
				<div class="col-md-auto sep-items">
					<a href="/users/{{ $pole->respo->id }}" class="user-link">
						<div class="card p-2 rounded chef-projet" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
							<div class="row no-gutters align-items-center" style="flex-wrap: unset; height: 100% !important;">
								<div class="col-md-4" style="width: 60px !important;">
									<img src="{{ asset('storage/' . $pole->respo->profil_picture) }}" class="card-img profil-rounded" style="width: 60px !important; height: 60px !important;">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<h5 class="card-title" style="margin-bottom: 0;"> {{ $pole->respo->name }}</h5>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>

		@can ('create', 'App\Cours')
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<a class="btn btn-primary btn-rounded" href="/poles/competitionscours/create">Créer une compétition</a>
			</div>
		@endcan
		@can ('update', $pole)
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Éditer</button>
			</div>
		@endcan

    </div>
</div>
@endsection
