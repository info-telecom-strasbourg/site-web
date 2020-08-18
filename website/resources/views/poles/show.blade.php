<!-- Button to display a pole -->

@extends('layouts.layout')

@section('title', 'Pôle ' . $pole->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item">Pôle {{ strtolower($pole->title) }}</li>
@endsection

@section('content')
<div class="container">
	<!-- Title of the pole -->
    <h1 class="title lg text-center">
        Pôle {{ $pole->title }}
    </h1>
	<hr class="line-under-title">
	
	<!-- Description of the pole -->
	<div class="container pt-3">
        <p>{{ $pole->desc }}</p>
        
        @if ($pole->slug == 'programmation_utilitaire')
        	<h4 class="title md text-left">Nos programmes utilitaires</h4>
        @else
        	<h4 class="title md text-left">Nos {{ strtolower($pole->title) }}</h4>
        @endif
		
		<!-- Display all the projects of the pole -->
		<div class="container pt-5">
			@include('partials.list-cards', ['items' => $pole->projets, 'errorMessage' => "Aucun projet n'a été trouvée", 'routeName' => 'projets.show'])
		</div>
		
		<!-- Button to see more -->
		@if(isset($pole->projets) && $pole->projets->count() > 8)
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
		
		<!-- Button to edit the pole -->
		@can ('update', $pole)
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Éditer</button>
			</div>
		@endcan

		<hr>

        @include('partials.comments', ['routeName' => 'comments.poles.pole.store', 'object' => $pole])
    </div>

</div>
@endsection
