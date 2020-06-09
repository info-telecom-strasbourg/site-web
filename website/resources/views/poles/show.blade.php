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

			<div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
				<img class="card-img-top" src="/images/projets/Objection.png" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title text-center font-weight-bold">Objection !</h5>
					<p class="card-text">Avis, argument, etc., que l'on met en avant pour s'opposer à une proposition, une affirmation.</p>
					<a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
				</div>
		  	</div>

            <!-- ICI METTRE LE FORELSE -->
            {{--
            @forelse ($pole->projets as $projet)
                {{ $projet->title }}
            @empty
                Pas de projet disponible
            @endforelse --}}

			<!-- Bouton "Voir-plus" -->

            <div class="d-flex justify-content-center">
              <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
              <div class="p-2 bd-highlight"><input class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
              <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
            </div>
			<h4 class="title md text-left">Responsable {{ $pole->title }}</h4>
			{{ $pole->respo->name }}
        </div>





    </div>
</div>
@endsection
