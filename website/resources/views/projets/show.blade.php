@extends('layouts.layout')

@section('title', "Projet ITS - ". $projet->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="/projets?page={{ intval($projet->id / 24) + 1 }}">Projets</a></li>
    <li class="breadcrumb-item active">{{ $projet->title }}</li>
@endsection

@section('content')

<div class="container">
    <h1 class="title lg text-center">
        {{ $projet->title }}
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <h2>
            Chef de projet
        </h2>
        <div class="card p-2 rounded" style="max-width: 220px;">
            <div class="row no-gutters">
                <div class="col-md-4" style="max-width: 60px;">
                    <img src="/images/logo/logo.png" class="card-img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $projet->chef->name }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <h2>Participants</h2>
        @foreach ($projet->participants as $participant)
            <p>{{ $participant->name }}</p>
        @endforeach
        <h2>Le projet en images</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <h2>
            Liens utiles
        </h2>
    </div>
</div>

@endsection
