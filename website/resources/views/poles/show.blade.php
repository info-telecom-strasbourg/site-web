@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ $pole->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $pole->desc }} </p>
            <h4 class="title md text-left">Projets</h4>

			<!-- Exemple de carte -->

			<div class="card text-center shadow mb-5 bg-white rounded" hidden>
				<img class="card-img-top" src="/images/projets/Objection.png"
				alt="Card image cap">
				<div class="card-body d-flex flex-column">
					<h5 class="card-title text-center font-weight-bold">
						Objection !
					</h5>
					<p class="card-text">Avis, argument, etc., que l'on met en
						avant pour s'opposer à une proposition, une affirmation.
					</p>
					<a href="#" class="btn btn-rounded btn-primary"
					type="button">Découvrir</a>
				</div>
		  	</div>

			<!-- Liste des projets -->
			<div class="container pt-5">
				<div class="row justify-content-center">

					@if(isset($pole->projets))

						<?php $pos=0; ?>
						@forelse ($pole->projets as $projet)

						<div id="proj-card" class="col-md-auto sep-items">
							<div class="card text-center rounded">
								<img class="card-img-top" src="/images/projets/Objection.png" alt="Card image cap">
								<div class="card-body d-flex flex-column">
									<h5 class="card-title text-center font-weight-bold">
										{{ $projet->title }}
									</h5>
									<p class="card-text">
										<span>{{ mb_strlen( $projet->desc ) > 200 ? mb_substr($projet->desc, 0, 200) . ' ...' : $projet->desc }}
		                                </span>
									</p>
									<a href="/poles/{{ $projet->id }}" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
								</div>
						  	</div>
						</div>
						<?php $pos++; ?>
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

            <div id="voir-plus" class="d-flex justify-content-center">
              <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
              <div class="p-2 bd-highlight"><input class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
              <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
            </div>
			<h4 class="title md text-left">Responsable {{ $pole->title }}</h4>
			<div class="text-left">
				<a href="#" class="link-member">
					<img src="/images/projets/Objection.png" class="profil-rounded mr-md-3"/>
					{{ $pole->respo->name }}
				</a>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Edit</button>
			</div>
        </div>





    </div>
</div>
@endsection

<!--
Bouton Edit si on est le respo
 -->
