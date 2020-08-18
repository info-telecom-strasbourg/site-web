<!-- Display a lesson -->

@extends('layouts.layout')

@section('title', 'Cours ITS - ' . $cours->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/cours">Pôle cours & accompagnement</a></li>
<li class="breadcrumb-item active">{{ $cours->title }}</li>
@endsection

@section('content')
<div class="container" id="cours">
	<!--Title of the lesson -->
	<h1 class="title lg text-center">
		{{ $cours->title }}
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<div class="container" id="description" style="margin-top: 50px;">
			<div class="row">
				<!--Image to illustrate the lesson -->
				<div class="col-3 disp">
					<img src="{{ asset('storage/' . json_decode($cours->images)[0]) }}" alt="Decriptive image" style="width: 195px; height: 100%;">
				</div>

				<!--Description of the lesson -->
				<div class="col-9 disp">
					<p>{{ $cours->desc }}</p>
				</div>
			</div>
		</div>
		<div class="bordure"></div>

		<!--Creators of the lesson -->
		<h4 class="title md text-center">Créateurs du cours</h4>
		<div class="container" style="padding-top: 1rem !important; margin-bottom: -35px;">
			<div class="row align-items-center">
				@if (isset($cours))
					@forelse ($cours->creators as $creator)
						<div class="col-md-auto sep-items">
							<a href="/users/{{ $creator->id }}" class="user-link">
								<div class="card p-2 rounded chef-projet" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
									<div class="row no-gutters align-items-center" style="flex-wrap: unset; height: 100% !important;">
										<div class="col-md-4" style="width: 60px !important;">
											<img src="{{ asset('storage/' . $creator->profil_picture) }}" class="card-img profil-rounded" style="width: 60px !important; height: 60px !important;">
										</div>
										<div class="col-md-8">
											<div class="card-body">
												<h5 class="card-title" style="margin-bottom: 0;"> {{ $creator->name }}</h5>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					@empty
						<div class="col-md-auto sep-items">
							Ce cours a été créé par un anonyme
						</div>
					@endforelse
				@else
					<h4 class="title md text-center">
						Ce cours n'existe pas
					</h4>
				@endif
			</div>
		</div>

		<!-- Dates of the lesson in face-to-face -->
		<div class="bordure"></div>
		<h4 class="title md text-center">Dates en présentiel</h4>
		<div class="container" style="margin-top: 30px;">
			@if (isset($cours))
				@php $datesPresentiel = 0; @endphp
				@forelse ($cours->dates as $date)
					@if ($date->presentiel == 1)
						<div class="row align-items-center">
							<div class="col-auto sep-chevr">
								<i id="chevron-date-supports" class="far fa-calendar-alt fa-2x">
								</i>
							</div>
							<div class="col sep-chevr">
								{{ \Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y') }}
							</div>
						</div>
						@php $datesPresentiel += 1; @endphp
					@endif
				@empty
				@endforelse

			@endif
			@if ($datesPresentiel == 0)
				<div>
					Aucune date en présentiel n'est prévue pour ce cours.
				</div>
			@endif
		</div>

		<!-- Dates of the lesson on Discord -->
		<div class="bordure"></div>
		<h4 class="title md text-center">Dates en distanciel (sur Discord)</h4>
		<div class="container" style="margin-top: 30px;">
			@if (isset($cours))
				@php $datesDistanciel = 0; @endphp
				@forelse ($cours->dates as $date)
					@if ($date->presentiel == 0)
						<div class="row align-items-center">
							<div class="col-auto sep-chevr">
								<i id="chevron-date-supports" class="far fa-calendar-alt fa-2x">
								</i>
							</div>
							<div class="col sep-chevr">
								{{ \Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y') }}
							</div>
						</div>
						@php $datesDistanciel += 1; @endphp
					@endif
				@empty
				@endforelse

			@endif
			@if ($datesDistanciel == 0)
				<div>
					Aucune date en distanciel n'est prévue pour ce cours.
				</div>
			@endif
		</div>

		<!-- Files linked to the lesson -->
		@if (!empty($cours->supports[0]))
			<div class="bordure"></div>
			<h4 class="title md text-center">Support</h4>
			<div id="select-files" class="container">
				@foreach ($cours->supports as $support)
					<div class="row align-items-center">
						@if ($support->visibility == 1)
							@auth
								<a class="link-black row align-items-center" href="/download/{{ $support->id }}">
									<div class="col-auto sep-chevr">
										<i id="chevron-date-supports" class="fas fa-download fa-2x"></i>
									</div>
									<div class="bd-highlight col sep-chevr">
											{{ $support->name }}
									</div>
								</a>
								<div class="w-100"></div>
							@endauth
						@else
							<a class="link-black row align-items-center" href="/download/{{ $support->id }}">
								<div class="col-auto sep-chevr">
									<i id="chevron-date-supports" class="fas fa-download fa-2x"></i>
								</div>
								<div class="bd-highlight col sep-chevr">
										{{ $support->name }}
								</div>
							</a>
							<div class="w-100"></div>
						@endif
					</div>
				@endforeach
			</div>
		@endif

		<!-- Buttons to edit or remove a lesson -->
		@can('update', $cours)
		    <div class="d-flex flex-row justify-content-around" style="margin-top: auto;">
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/edit">Éditer</a>
				</div>
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/destroy">Supprimer</a>
				</div>
			</div>
		@endcan

		<hr>

		@include('partials.comments', ['routeName' => 'comments.poles.cours.store', 'object' => $cours])
	</div>
</div>
@endsection
