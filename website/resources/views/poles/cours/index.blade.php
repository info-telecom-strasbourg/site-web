<!-- Display all the lessons -->

@extends('layouts.layout')

@section('title', 'Pôle ' . $pole->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Pôle {{ $pole->title }}</li>
@endsection

@section('content')
<div class="container">
	<!-- Display the lesson pole -->
    <h1 class="title lg text-center">
        Pôle {{ $pole->title }}
    </h1>
    <hr class="line-under-title">

	<div class="container pt-3">
		<!-- Display the lesson pole description-->
		<p>{{ $pole->desc }}</p>
		<!-- Display all the lessons -->
        <h4 class="title md text-left">Liste des cours</h4>

		@include('partials.list-cards', ['items' => $lessons, 'errorMessage' => "Aucun cours n'a été trouvée", 'routeName' => 'poles.cours.show'])

		<!-- Button to see more -->
		@if(isset($lessons) && $lessons->count() > 6)
	        @include('partials.voirplus', ['id' => 'cours', 'element' => 'element'])
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
				<a class="btn btn-primary btn-rounded" href="/poles/cours/create">Créer un cours</a>
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
