@extends('layouts.layout')

@section('content')
<div class="container" id="cours">

	<div class="content-fluid">
		<h1 class="title lg text-center">
			{{ $cours->title }}
		</h1>
		<hr class="line-under-title">
		<div>
			<div class="container" id="description" style="margin-top: 50px;">
				<div class="row">
					<div class="col-3 disp">
						<img src="{{ asset('storage/'.json_decode($cours->image)[0]) }}" alt="Decriptive image">
					</div>
					<div class="col-9 disp">
						<p>{{ $cours->desc }}</p>
					</div>
				</div>
			</div>
			<div class="bordure"></div>
			<h4 class="title md text-center">Créateurs du cours</h4>
			<!-- Créateurs -->
			<div class="container pt-5" style="padding-top: 1rem !important; margin-bottom: -35px;">
				<div class="row align-items-center">
					@if(isset($cours))
					@forelse ($cours->creators as $creator)
					<div class="col-md-auto sep-items">
						<a href="/users/{{ $creator->id }}" class="user-link">
							<div class="card p-2 rounded" style="max-width: 220px; cursor: pointer;">
								<div class="row no-gutters align-items-center" style="flex-wrap: unset">
									<div class="col-md-4" style="max-width: 60px;">
										<img src="{{ asset('storage/'.json_decode($creator->profil_picture)[0]) }}" class="card-img">
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
					<div>
						Ce cours a été créé par un anonyme
					</div>
					@endforelse
					@else
					<h4 class="title md text-center">Ce cours n'existe pas</h4>
					@endif
				</div>
			</div>

			<!-- Dates en présentiels -->
			<div class="bordure"></div>
			<h4 class="title md text-center">Dates en présentiels</h4>
			<div class="container" style="margin-top: 30px;">
				@if(isset($cours))
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
				@endif
				@empty
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				@endforelse

				@else
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				@endif
			</div>

			<!-- Dates en distanciels -->
			<div class="bordure"></div>
			<h4 class="title md text-center">Dates en distanciels (sur Discord)</h4>
			<div class="container" style="margin-top: 30px;">
				@if(isset($cours))
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
				@endif
				@empty
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				@endforelse

				@else
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				@endif
			</div>


			<!-- Références -->
			@if(isset($cours->links))
			<div class="bordure"></div>
			<h4 class="title md text-center">Références</h4>
			@foreach (json_decode($cours->links, true) as $link)
			<div class="row align-items-center">
				<div class="col-auto sep-chevr">
					<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
					</i>
				</div>
				<div class="col sep-chevr">
					<a href="{{ $link }}" class="link-black" target="_blank">{{ $link }}</a>
				</div>
			</div>
			@endforeach
			@endif


			<!-- Supports -->
			@if (!empty($cours->supports[0]))
			<div class="bordure"></div>
			<h4 class="title md text-center">Support</h4>
			<!-- Bouton pour DL le support -->
			<!-- TODO dans autres pages -->
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

			@can('update', $cours)
			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/edit">Editer</a>
			</div>
			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/destroy">Supprimer</a>
			</div>
			@endcan

		</div>
	</div>
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
