@extends('partials.pole-index', [
	'listTitle' => 'Liste des compétitions', 
	'items' => $competitions,
	'pole' => $pole,
	'isCover' => 'true',
	'errorMessage' => "Aucune compétition n'a été trouvée",
	'routeNameShow' => 'poles.competitions.show',
	'routeNameComments' => 'comments.poles.pole.store'
])

@section('see-more-button')
	<!-- Button to see more -->
	@if(isset($competitions) && $competitions->count() > 6)
		@include('partials.voirplus', ['id' => 'compet', 'element' => 'element'])
	@endif
@endsection

@section('extra-button')
	@can ('create', 'App\Competition')
		<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
			<a class="btn btn-primary btn-rounded" href="/poles/competitions/create">Créer une compétition</a>
		</div>
	@endcan
@endsection

@section('timeline')
		<!-- Sort dates -->
		@php
			use Carbon\Carbon;
			function isInPast($date, $today_date) {
				return (intval(substr($date, 0, 4)) > intval(substr($today_date, 0, 4)) ||
				 	intval(substr($date, 5, 2)) > intval(substr($today_date, 5, 2)) ||
					intval(substr($date, 8, 2)) > intval(substr($today_date, 8, 2)));
			}

			$today_date =  Carbon::now('Europe/Paris')->format('Y-m-d');
			$pastEvents = array();
			$futurEvents = array();
			$todayEvent = "today";

		    foreach ($pole->timeline as $event) {

				if($event->date == $today_date)
					$todayEvent = $event;
		        else if(isInPast($event->date, $today_date))
					$futurEvents[] = $event;
		        else
		            $pastEvents[] = $event;
			}
		@endphp

		<!-- Timeline of the pole -->
		@if(!$pole->timeline->isEmpty() || (Auth::check() && Auth::user()->can('update', $pole)))

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
@endsection