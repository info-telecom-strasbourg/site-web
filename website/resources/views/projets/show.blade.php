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
        @if ($projet->complete == 1) 
            <div class="alert alert-success" role="alert">
                Projet finis
            </div>
        @else
            <div class="alert alert-info" role="alert">
                Projet en cours
            </div>
        @endif
        <p>{{ $projet->desc }}</p>
        <div class="bordure"></div>
        <h4 class="title md text-center">Chef de projet</h4>
        <div class="container pt-5" style="padding-top: 1rem !important; margin-bottom: -35px;">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-auto sep-items">
                    <a href="/users/{{ $projet->chef->id }}" class="user-link">
                        <div class="card p-2 rounded chef-projet" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
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
            </div>
        </div>


        <!-- Participants -->
        @if (!$projet->participants->isEmpty())
            <div class="bordure"></div>
            <h4 class="title md text-center">Participants</h4>
            @foreach ($projet->participants as $participant)
                <p>{{ $participant->name }}</p>
            @endforeach
        @endif

        <!-- Collaborateur -->
        @if(!empty($projet->collaborateur))
            <div class="bordure"></div>
            <h4 class="title md text-center">Collaborateurs</h4>
            <p>{{ $projet->collaborateur->name }}</p>
        @endif

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

        <div class="bordure"></div>
        <h4 class="title md text-center">Liens utiles</h4>
        <div class="social-buttons row align-item-center justify-content-center" id="projet-show" style="margin-bottom: 40px;">
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_github }}">
                <i class="fab fa-github fa-3x fa-lg mr-3"></i>Github
            </a>
            @if(!empty($projet->link_download))
                <a class="social-icons d-flex align-items-center" href="{{ $projet->link_download }}">
                    <i class="fas fa-download fa-3x fa-lg mr-3"></i>Téléchargement
                </a>
            @endif
            <a class="social-icons d-flex align-items-center" href="{{ $projet->link_doc }}">
                <i class="far fa-file-alt fa-3x fa-lg mr-3"></i>Documentation
            </a>
        </div>

        @can ('update', $projet)
            <div class="d-flex flex-row justify-content-around" style="margin-top: auto;">
                <div class="text-center" style="margin-top:25px; margin-bottom:25px;">
                    <button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/projets/{{ $projet->id }}/edit'">Éditer</button>
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
