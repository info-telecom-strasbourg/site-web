@extends('layouts.layout')

@section('title', "Projet ITS - ". $projet->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/projets?page={{ intval($projet->id / 24) + 1 }}">Projets</a></li>
<li class="breadcrumb-item active">{{ $projet->title }}</li>
@endsection

@section('content')

<div class="container" id="projet">
    <h1 class="title lg text-center">
        {{ $projet->title }}
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <p>{{ $projet->desc }}</p>
        <div class="bordure"></div>
        <h4 class="title md text-center">Chef de projet</h4>
            <div class="card p-2 rounded chef-projet" style="max-width: 220px; cursor: pointer;">
				<a href="/users/{{ $projet->chef->id }}" class="user-link">
	                <div class="row no-gutters align-items-center" style="flex-wrap: unset">
	                    <div class="col-md-4" style="max-width: 60px;">
	                        <img src="/images/defaut/profil.jpg" class="card-img">
	                    </div>
	                    <div class="col-md-8">
	                        <div class="card-body">
	                            <p class="card-title" style="margin-bottom: 0;"> {{ $projet->chef->name }}</p>
	                        </div>
	                    </div>
	                </div>
				</a>
            </div>

        @if(!$projet->participants->isEmpty())
        <div class="bordure"></div>
        <h4 class="title md text-center">Participants</h4>
        @foreach ($projet->participants as $participant)
        <p>{{ $participant->name }}</p>
        @endforeach
        @endif
        @if(!empty($projet->collaborateur))
        <div class="bordure"></div>
        <h4 class="title md text-center">Collaborateurs</h4>
        <p>{{ $projet->collaborateur->name }}</p>
        @endif
        <div class="bordure"></div>
        <h4 class="title md text-center">Le projet en images</h4>
        <div style="display : flex; justify-content :center; margin-top: 40px; margin-bottom: 40px;">
            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('storage/'.json_decode($projet->images)[0]) }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="Third slide">
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="background-color: #1b1b1b; width: 40px; height: 40px; border-radius: 50%; top: 50%; margin-left: 10px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="background-color: #1b1b1b; width: 40px; height: 40px; border-radius: 50%; top: 50%; margin-right: 10px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="bordure"></div>
        <h4 class="title md text-center">Liens utiles</h4>
        <div class="social-buttons row align-item-center justify-content-center" id="projet-show">
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_github }}">
                <i class="fab fa-github fa-3x fa-lg mr-3"></i>Github
            </a>
            @if(!empty($projet->link_download))
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_download }}">
                <i class="fas fa-download fa-3x fa-lg mr-3"></i>Téléchargement
            </a>
            @endif
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_doc }}">
                <i class="fas fa-envelope fa-3x fa-lg mr-3"></i>Documentation
            </a>
        </div>
    </div>
</div>

@endsection
