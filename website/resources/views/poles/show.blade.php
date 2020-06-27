@extends('layouts.layout')

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
									<img class="card-img-top" src="{{ asset('storage/'.json_decode($projet->images)[0]) }}" alt="Card image cap">
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
			<div class="text-left">
				<a href="#" class="link-member">
					<img src="{{ asset('storage/'.json_decode($pole->respo->profil_picture)[0]) }}" class="profil-rounded mr-md-3"/>
					{{ $pole->respo->name }}
				</a>
			</div>
			@auth
				@if ( $pole->respo->id == Auth::user()->id)
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Edit</button>
					</div>
				@endif
			@endauth
        </div>

    </div>
</div>
@endsection

<!--
Bouton Edit si on est le respo
 -->
