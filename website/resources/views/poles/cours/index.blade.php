@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ $pole->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $pole->desc }}</p>
            <h4 class="title md text-left">Liste des cours</h4>
			<div class="container">
				@forelse ($cours as $cour)
					<div id="cours-liste" class="row align-items-center">
						<div class="col-auto sep-chevr">
							<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
							</i>
						</div>
						<div class="col sep-chevr">
							<a href="/poles/cours/{{ $cour->id }}" class="link-black">{{ $cour->title }}</a>
						</div>
					</div>
				@empty
					<div>
						Il n'y a pas de cours disponibles.
					</div>
				@endforelse
			</div>

			@if(isset($cours) && $cours->count() > 8)
		        <div id="line-btn-vp" class="d-flex justify-content-center">
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		        </div>
			@endif


	    </div>
	</div>
</div>
@endsection

<!--
Bouton edit si on est le créateur du cours_id
Lien vers la page du cours
Mise en page
 -->
