@extends('layouts.layout')

@section('title', 'Pôle ' . $pole->title)

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

		<!-- Display all the competitions -->
		<div class="container pt-5">
			@include('partials.list-cards', ['items' => $competitons, 'errorMessage' => "Aucune compétition n'a été trouvée", 'routeName' => 'poles.competitions.show', 'isCover' => true])
		</div>

		<!-- Button to see more -->
		@if(isset($competitons) && $competitons->count() > 6)
			@include('partials.voirplus', ['id' => 'compet', 'element' => 'element'])
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

		@can ('create', 'App\Competition')
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<a class="btn btn-primary btn-rounded" href="/poles/competitions/create">Créer une compétition</a>
			</div>
		@endcan
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
