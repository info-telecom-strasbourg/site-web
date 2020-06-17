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
					<div class="row align-items-center">
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
	    </div>
	</div>
</div>
@endsection

<!--
Bouton edit si on est le créateur du cours_id
Lien vers la page du cours
Mise en page
 -->
