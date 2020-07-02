@extends('layouts.layout')

@section('title', 'Compétition ITS - ' . $competitions->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/cours">Pôle compétitions</a></li>
<li class="breadcrumb-item active">{{ $competitions->title }}</li>
@endsection

@section('content')
<div class="container" id="cours">
	<h1 class="title lg text-center">
		{{ $competitions->title }}
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<div class="container" id="description" style="margin-top: 50px;">
			<div class="row">
				<div class="col-3 disp">
					<img src="{{ asset('storage/' . json_decode($competitions->images)[0]) }}" alt="Decriptive image">
				</div>
				<div class="col-9 disp">
					<p>{{ $competitions->desc }}</p>
				</div>
			</div>
		</div>
		<div class="bordure"></div>

		<!-- Dates en présentiel -->
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

		<!-- Dates en distanciel -->
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


		<!-- Références -->
		@if (isset($cours->links))
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
		    <div class="d-flex flex-row justify-content-around" style="margin-top: auto;">
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/edit">Éditer</a>
				</div>
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/destroy">Supprimer</a>
				</div>
			</div>
		@endcan
	</div>
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
