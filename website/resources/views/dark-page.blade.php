@extends('layouts.layout')

@section('title', "ITS")

@section('breadcrumb')

@endsection

@section('content')

<style>
    #content {
        padding-bottom: 0;    /* Footer height */
    }
</style>

<section class="dark-page" id="vue-ens">
    <div class="bandeau-dark">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle total" type="button" data-toggle="dropdown">
                <img class="profil-rounded" src="images/defaut/profil.jpg">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Profil</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle short" type="button" data-toggle="dropdown">
                <img class="profil-rounded" src="images/defaut/profil.jpg">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Profil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="nav flex-column nav-pills short" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
        <div class="navbar-dark-brand" href="/">
            <a href="/">
                <img src="/images/logo/logo-dark.png" width="90" height="90" alt="Logo du site">
            </a>
        </div>
        <a class="nav-link active" id="v-pills-ens-tab" data-toggle="pill" href="#v-pills-ens" role="tab" aria-controls="v-pills-ens" aria-selected="true">VUE D'ENSEMBLE</a>
        <a class="nav-link" id="v-pills-actu-tab" data-toggle="pill" href="#v-pills-actu" role="tab" aria-controls="v-pills-actu" aria-selected="false">ACTUALITES</a>
        <a class="nav-link" id="v-pills-helpdesk-tab" data-toggle="pill" href="#v-pills-helpdesk" role="tab" aria-controls="v-pills-helpdesk" aria-selected="false">HELPDESK</a>
        <a class="nav-link" id="v-pills-membres-tab" data-toggle="pill" href="#v-pills-membres" role="tab" aria-controls="v-pills-membres" aria-selected="false">MEMBRES</a>
    </div>
    <div class="container">
        <div class="nav flex-column nav-pills total" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="navbar-dark-brand" href="/">
                <a href="/">
                    <img src="/images/logo/logo-dark.png" width="90" height="90" alt="Logo du site">
                </a>
            </div>
            <a class="nav-link active" id="v-pills-ens-tab" data-toggle="pill" href="#v-pills-ens" role="tab" aria-controls="v-pills-ens" aria-selected="true">VUE D'ENSEMBLE</a>
            <a class="nav-link" id="v-pills-actu-tab" data-toggle="pill" href="#v-pills-actu" role="tab" aria-controls="v-pills-actu" aria-selected="false">ACTUALITES</a>
            <a class="nav-link" id="v-pills-helpdesk-tab" data-toggle="pill" href="#v-pills-helpdesk" role="tab" aria-controls="v-pills-helpdesk" aria-selected="false">HELPDESK</a>
            <a class="nav-link" id="v-pills-membres-tab" data-toggle="pill" href="#v-pills-membres" role="tab" aria-controls="v-pills-membres" aria-selected="false">MEMBRES</a>
        </div>
        <div class="tab-content" id="v-pills-tabContent" style="padding-bottom: 400px">
            <div class="tab-pane fade show active" id="v-pills-ens" role="tabpanel" aria-labelledby="v-pills-ens-tab">
                <h1 class="title lg text-center"> Vue d'ensemble </h1>
                <hr class="line-under-title">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="tab-pane fade" id="v-pills-actu" role="tabpanel" aria-labelledby="v-pills-actu-tab">
                <h1 class="title lg text-center"> Actualités </h1>
                <hr class="line-under-title">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="tab-pane fade" id="v-pills-helpdesk" role="tabpanel" aria-labelledby="v-pills-helpdesk-tab">
                <h1 class="title lg text-center"> Helpdesk </h1>
                <hr class="line-under-title">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="tab-pane fade" id="v-pills-membres" role="tabpanel" aria-labelledby="v-pills-membres-tab">
                <h1 class="title lg text-center"> Membres </h1>
                <hr class="line-under-title">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</section>


@endsection