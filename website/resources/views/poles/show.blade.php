@extends('layouts.layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item">Pôle {{ $pole->title }}</li>
@endsection

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ ucfirst($pole->title) }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $pole->desc }}</p>
            <h4 class="title md text-left">{{ $pole->title }}</h4>

			<!-- Liste des projets -->
			<div class="container pt-5">
				<div class="row justify-content-center">

					@if(isset($pole->projets))

						@forelse ($pole->projets as $projet)

							<div id="proj-card" class="col-md-auto sep-items">
								<div class="card text-center rounded">
									<img class="card-img-top" src="{{ asset(json_decode($projet->images)[0]) }}" alt="Card image cap">
									<div class="card-body d-flex flex-column">
										<h5 class="card-title text-center font-weight-bold">
											{{ $projet->title }}
										</h5>
										<p class="card-text">
											<span>{{ mb_strlen( $projet->desc ) > 200 ? mb_substr($projet->desc, 0, 200) . ' ...' : $projet->desc }}
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
			</div>

			<!-- Bouton "Voir-plus" -->
			@if(isset($pole->projets) && $pole->projets->count() > 8)
		        <div id="line-btn-vp" class="d-flex justify-content-center">
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		        </div>
			@endif



			<h4 class="title md text-left">Responsable {{ $pole->title }}</h4>
			<div class="container pt-5" style="padding-top: 1rem !important; margin-bottom: -35px;">
				<div class="row align-items-center">
					<div class="col-md-auto sep-items">
						<a href="/users/{{ $pole->respo->id }}" class="user-link">
							<div class="card p-2 rounded chef-projet" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
								<div class="row no-gutters align-items-center" style="flex-wrap: unset; height: 100% !important;">
									<div class="col-md-4" style="width: 60px !important;">
										<img src="{{ asset($pole->respo->profil_picture) }}" class="card-img profil-rounded" style="width: 60px !important; height: 60px !important;">
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
			
			@can ('update', $pole)
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Éditer</button>
				</div>
			@endcan
        </div>

    </div>
</div>
@endsection
