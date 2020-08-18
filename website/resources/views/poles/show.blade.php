<!-- Button to display a pole -->

@extends('layouts.layout')

@section('title', 'Pôle ' . $pole->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item">Pôle {{ strtolower($pole->title) }}</li>
@endsection

@section('content')
<div class="container" id="pole">
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
			<div class="row justify-content-center">

				@if(isset($pole->projets))

					@forelse ($pole->projets as $projet)

						<div id="proj-card" class="col-md-auto sep-items">
							<div class="card text-center rounded">
								<img class="card-img-top" src="{{ asset('storage/' . json_decode($projet->images)[0]) }}" alt="Card image cap">
								<div class="card-body d-flex flex-column">
									<h5 class="card-title text-center font-weight-bold">
										{{ $projet->title }}
									</h5>
									<p class="card-text">
										<span>{{ mb_strlen( $projet->desc ) > 200 ? mb_substr($projet->desc, 0, 200) . ' ...' : $projet->desc }}
		                                </span>
									</p>
									<a href="/projets/{{ $projet->id }}" class="btn btn-rounded btn-primary">DÉCOUVRIR</a>
								</div>
						  	</div>
						</div>

					@empty

						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucun projet n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>
					@endforelse

				@else
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun projet n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
					</div>

				@endif
			</div>
		</div>

		<!-- Button to see more -->
		@if(isset($pole->projets) && $pole->projets->count() > 8)
	        <div id="line-btn-vp" class="d-flex justify-content-center">
	          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
	          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
	          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
	        </div>
		@endif

		<!-- Sort dates -->
		@php
		    use Carbon\Carbon;
		    $today_date = Carbon::now();
			$pastEvents = array();
			$futurEvents = array();
			$todayEvent = "today";

		    foreach ($pole->timeline as $event) {
		        $expire_date = Carbon::createFromFormat('Y-m-d', $event->date);
		        $data_difference = $today_date->diffInDays($event->date, false);

				if($expire_date->isToday())
					$todayEvent = $event;
		        else if($today_date->lt($event->date, false))
		            $futurEvents[] = $event;
		        else
		            $pastEvents[] = $event;
			}
		@endphp

		<!-- Timeline of the pole -->
		@if(!$pole->timeline->isEmpty() || (Auth::check() && Auth::user()->id == $pole->respo->id ))

		<div class="bordure"></div>
        <h4 class="title md text-center">Timeline du pôle</h4>
        <div class="container mt-5 mb-5">
            <div class="row">
                <ul class="timeline">
                    @forelse($futurEvents as $event)
                    <li>
                        <div style="color: #007bff">
                            {{ \Carbon\Carbon::parse($event->date)->translatedFormat('j F Y') }}
                            @can ('update', $pole)
                            <button id="button-upd-step" type="button" data-toggle="modal" data-target="#upd-step{{ $event->id }}"><i class="buttons-timeline-edit fas fa-pen"></i><span style="margin-left: 10px; color:#2d64ba;">Modifier</span></button>
                            <a id="button-trash" href="/timeline/{{ $event->id }}/destroy"><i class="buttons-timeline-trash fas fa-trash"></i><span style="margin-left: 10px; color:#de4242;">Supprimer</span></a>
                            @endcan
                        </div>
                        <p>{{$event->desc}}</p>
                    </li>
					@empty
                    @endforelse
					@if($todayEvent != "today")
					<li id="today">
						<div style="color: #007bff">Aujourd'hui
							@can ('update', $pole)
                            <button id="button-upd-step" type="button" data-toggle="modal" data-target="#upd-step{{ $todayEvent->id }}"><i class="buttons-timeline-edit fas fa-pen"></i><span style="margin-left: 10px; color:#2d64ba;">Modifier</span></button>
							<a id="button-trash" href="/timeline/{{ $todayEvent->id }}/destroy"><i class="buttons-timeline-trash fas fa-trash"></i><span style="margin-left: 10px; color:#de4242;">Supprimer</span></a>
                            @endcan
                        </div>
                        <p>{{$todayEvent->desc}}</p>
					</li>
					@else
                    <li id="today">
                        <div style="color: #007bff">Aujourd'hui</div>
                    </li>
					@endif

					@forelse($pastEvents as $event)
                    <li>
                        <div style="color: #007bff">
                            {{ \Carbon\Carbon::parse($event->date)->translatedFormat('j F Y') }}
                            @can ('update', $pole)
                            <button id="button-upd-step" type="button" data-toggle="modal" data-target="#upd-step{{ $event->id }}"><i class="buttons-timeline-edit fas fa-pen"></i><span style="margin-left: 10px; color:#2d64ba;">Modifier</span></button>
                            <a id="button-trash" href="/timeline/{{ $event->id }}/destroy"><i class="buttons-timeline-trash fas fa-trash"></i><span style="margin-left: 10px; color:#de4242;">Supprimer</span></a>
                            @endcan
                        </div>
                        <p>{{$event->desc}}</p>
                    </li>
					@empty
                    @endforelse
                </ul>
            </div>
        </div>

		@endif

		<!-- The forms of the timeline -->
		@can ('update', $pole)
			@include('poles.timeline', ['object' => $pole ])
		@endcan

		<!-- Responsable -->
		<div style="margin-bottom: 100px;"></div>
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
				<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Modifier</button>
			</div>
		@endcan
    </div>

</div>
@endsection
