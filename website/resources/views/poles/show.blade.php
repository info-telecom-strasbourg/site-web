<!-- Button to display a pole -->

@extends('partials.pole-index', [
	'listTitle' => 'Nos ' . strtolower($pole->title),
	'items' => $pole->projets,
	'pole' => $pole,
	'isCover' => 'false',
	'errorMessage' => "Aucun projet n'a été trouvée",
	'routeNameShow' => 'projets.show',
	'routeNameComments' => 'comments.poles.pole.store'
])

@section('see-more-button')
    <!-- Button to see more -->
    @if (isset($pole->projets) && $pole->projets->count() > 6)
        @include('partials.voirplus', ['id' => 'projet', 'element' => 'element'])
    @endif
@endsection

@section('timeline')
    <!-- Sort dates: past/present/futur -->
    @php
		use Carbon\Carbon;
		function isInPast($date, $today_date) {
			return (intval(substr($date, 0, 4)) > intval(substr($today_date, 0, 4)) ||
			intval(substr($date, 5, 2)) > intval(substr($today_date, 5, 2)) ||
			intval(substr($date, 8, 2)) > intval(substr($today_date, 8, 2)));
		}

		$today_date = Carbon::now('Europe/Paris')->format('Y-m-d');
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
    @if (!$pole->timeline->isEmpty() || (Auth::check() && Auth::user()->can('update', $pole)))

        <div class="bordure"></div>
        <h4 class="title md text-center">Timeline du pôle</h4>
        <div class="container mt-5 mb-5">
            <div class="row">
                <ul class="timeline">
                    @forelse($futurEvents as $event)
                        <li>
                            <div style="color: #007bff">
                                {{ \Carbon\Carbon::parse($event->date)->translatedFormat('j F Y') }}
                                @can('update', $pole)
                                    <button id="button-upd-step" type="button" data-toggle="modal"
                                        data-target="#upd-step{{ $event->id }}"><i
                                            class="buttons-timeline-edit fas fa-pen"></i><span
                                            style="margin-left: 10px; color:#2d64ba;">Modifier</span></button>
                                    <a id="button-trash" href="/timeline/{{ $event->id }}/destroy"><i
                                            class="buttons-timeline-trash fas fa-trash"></i><span
                                            style="margin-left: 10px; color:#de4242;">Supprimer</span></a>
                                @endcan
                            </div>
                            <p style="white-space: pre-wrap">{{ $event->desc }}</p>
                        </li>
                    @empty
					@endforelse
					@if ($todayEvent != 'today')
						<li id="today">
							<div style="color: #007bff">Aujourd'hui
								@can('update', $pole)
									<button id="button-upd-step" type="button" data-toggle="modal"
										data-target="#upd-step{{ $todayEvent->id }}"><i class="buttons-timeline-edit fas fa-pen"></i><span
											style="margin-left: 10px; color:#2d64ba;">Modifier</span></button>
									<a id="button-trash" href="/timeline/{{ $todayEvent->id }}/destroy"><i
											class="buttons-timeline-trash fas fa-trash"></i><span
											style="margin-left: 10px; color:#de4242;">Supprimer</span></a>
								@endcan
							</div>
							<p style="white-space: pre-wrap">{{ $todayEvent->desc }}</p>
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
								@can('update', $pole)
									<button id="button-upd-step" type="button" data-toggle="modal" data-target="#upd-step{{ $event->id }}"><i
											class="buttons-timeline-edit fas fa-pen"></i><span
											style="margin-left: 10px; color:#2d64ba;">Modifier</span></button>
									<a id="button-trash" href="/timeline/{{ $event->id }}/destroy"><i
											class="buttons-timeline-trash fas fa-trash"></i><span
											style="margin-left: 10px; color:#de4242;">Supprimer</span></a>
								@endcan
							</div>
							<p style="white-space: pre-wrap">{{ $event->desc }}</p>
						</li>
					@empty
					@endforelse
    			</ul>
    		</div>
    	</div>

    @endif

    <!-- The forms of the timeline -->
    @can('update', $pole)
        @include('poles.timeline', ['object' => $pole ])
    @endcan
@endsection
