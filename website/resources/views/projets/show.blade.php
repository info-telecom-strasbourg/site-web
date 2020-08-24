<!-- Display a project -->

@extends('layouts.layout')

@section('title', 'Projet ITS - ' . $projet->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/projets?page={{ intval($projet->id / 24) + 1 }}">Projets</a></li>
<li class="breadcrumb-item active">{{ $projet->title }}</li>
@endsection

@section('content')

<div class="container" id="projet">
    <!-- Title of the project -->
    <h1 class="title lg text-center">
        {{ $projet->title }}
    </h1>
    <hr class="line-under-title">

    <!-- Stage of the project -->
    <div class="container pt-3">
        @if ($projet->complete == 1)
        <div class="alert alert-success" role="alert">
            Projet finis
        </div>
        @else
        <div class="alert alert-info" role="alert">
            Projet en cours
        </div>
        @endif
        <!-- Description of the project -->
        <p>{{ $projet->desc }}</p>
        <div class="bordure"></div>
        <div class="container" style="margin-bottom: -35px;">
            <div class="row align-items-center justify-content-between">

                <!-- Leader of the project -->
                <div class="col-md-auto sep-items">
                    <h4 class="title md text-center">Chef de projet</h4>
                    <a href="/users/{{ $projet->chef->id }}" class="user-link">
                        <div class="card p-2 rounded chef-projet mt-5" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
                            <div class="row no-gutters align-items-center" style="flex-wrap: unset; height: 100% !important;">
                                <div class="col-md-4" style="width: 60px !important;">
                                    <img src="{{ asset('storage/' . $projet->chef->profil_picture) }}" class="card-img profil-rounded" style="width: 60px !important; height: 60px !important;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="card-title" style="margin-bottom: 0;"> {{ $projet->chef->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Collaborators of the project -->
                @if(!empty($projet->collaborateur))
                <div class="col-md-auto sep-items">
                    <h4 class="title md text-center">Collaborateur</h4>
                    <a href="{{ $projet->collaborateur->link }}" class="user-link" target="_blank">
                        <div class="card p-2 rounded chef-projet mt-5" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
                            <div class="row no-gutters align-items-center" style="flex-wrap: unset; height: 100% !important;">
                                <div class="col-md-4" style="width: 60px !important;">
                                    <img src="{{ asset($projet->collaborateur->image) }}" class="card-img profil-rounded" style="height: 80% !important; height: 80%;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="card-title" style="margin-bottom: 0;"> {{ $projet->collaborateur->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>


        <!-- Other contributors of the project -->
        @if ($projet->participants->count() > 1)
        <div class="bordure"></div>
        <h4 class="title md text-center">Participants</h4>
        @foreach ($projet->participants as $participant)
        @if ($participant->id != $projet->chef->id)
        <p><a href="/users/{{ $participant->id }}" class="user-link">{{ $participant->name }}</a></p>
        @endif
        @endforeach
        @endif

		<!-- Sort dates: past/present/futur -->
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

		    foreach ($projet->timeline as $event) {

				if($event->date == $today_date)
					$todayEvent = $event;
		        else if(isInPast($event->date, $today_date))
					$futurEvents[] = $event;
		        else
		            $pastEvents[] = $event;
			}
		@endphp

        <!-- Timeline of the project -->
		@if(!$projet->timeline->isEmpty() || (Auth::check() && Auth::user()->id == $projet->chef->id ))
        <div class="bordure"></div>
        <h4 class="title md text-center">Timeline du projet</h4>
        <div class="container mt-5 mb-5">
            <div class="row">
                <ul class="timeline">
					@forelse($futurEvents as $event)
                    <li>
                        <div style="color: #007bff">
                            {{ \Carbon\Carbon::parse($event->date)->translatedFormat('j F Y') }}
                            @can ('update', $projet)
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
								@can ('update', $projet)
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
                            @can ('update', $projet)
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

        <!-- The buttons to the timeline -->
        @can ('update', $projet)
        @include('poles.timeline', ['object' => $projet ])
        @endcan

        <!-- Images of the project -->
        <div class="bordure"></div>
        <h4 class="title md text-center">Le projet en images</h4>
        <div class="row justify-content-center" style="margin-top: 40px; margin-bottom: 40px;">
            <div id="carouselProjetImage" class="carousel slide row w-100 justify-content-center" data-interval="false">
                <ol class="carousel-indicators">
                    @foreach (json_decode($projet->images) as $image)
                    <li data-target="#carouselProjetImage" data-slide-to="0" class="@if ($loop->first) active @endif"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner col-md-6" style="background-color: transparent;">
                    @foreach (json_decode($projet->images) as $key => $image)
                    <div class="carousel-item text-center @if ($loop->first) active @endif" style="background-color: transparent;">
                        <img src="{{ asset('storage/' . $image) }}" alt=" {{ $key }} slide" style="height: 300px !important;">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev col-md-3" href="#carouselProjetImage" role="button" data-slide="prev" style="background-color: #1b1b1b; width: 40px; height: 40px; border-radius: 50%; top: 50%; margin-left: 10px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next col-md-3" href="#carouselProjetImage" role="button" data-slide="next" style="background-color: #1b1b1b; width: 40px; height: 40px; border-radius: 50%; top: 50%; margin-right: 10px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- Links of the project (Github, download the documentation and dowload the project) -->
        <div class="bordure"></div>
        <h4 class="title md text-center">Liens utiles</h4>
        <div class="social-buttons row align-item-center justify-content-center" id="projet-show" style="margin-bottom: 40px;">
            @if(!empty($projet->link_github))
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_github }}" target="_blank">
                <i class="fab fa-github fa-3x fa-lg mr-3"></i>Github
            </a>
            @endif
            @if(!empty($projet->link_download))
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_download }}" target="_blank">
                <i class="fas fa-download fa-3x fa-lg mr-3"></i>Téléchargement
            </a>
            @endif
            @if(!empty($projet->link_doc))
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_doc }}" target="_blank">
                <i class="far fa-file-alt fa-3x fa-lg mr-3"></i>Documentation
            </a>
            @endif
        </div>

        <!-- Buttons to edit or remove the project -->
        @can ('update', $projet)
        <div class="d-flex flex-row justify-content-around" style="margin-top: auto;">
            <div class="text-center" style="margin-top:25px; margin-bottom:25px;">
                <button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/projets/{{ $projet->id }}/edit'">Modifier</button>
            </div>
            <div class="text-center" style="margin-top:25px; margin-bottom:25px;">
                <form action="/projets/{{ $projet->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-primary btn-rounded" onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?')">Supprimer</button>
                </form>
            </div>
        </div>
        @endcan
    </div>
</div>

@endsection