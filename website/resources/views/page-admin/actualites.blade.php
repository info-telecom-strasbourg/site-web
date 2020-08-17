<!-- The darkpage -->
<!-- WILL BE COMMENTED LATER -->
@extends('layouts.layout')

@section('title', 'Admin')

@section('breadcrumb')

@endsection

@section('content')

<style>
    #content {
        padding-bottom: 0;
    }
</style>


<section class="dark-page" id="vue-ens">
    <div class="bandeau-dark">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle total" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Profil</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                <a class="dropdown-item" href="/users/{{ Auth::user()->id }}">Profil</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                <img src="/images/logo/logo-dark.png" width="90" height="100%" alt="Logo du site">
            </a>
        </div>
        <a class="nav-link" href="/page-admin/vue-ensemble">VUE D'ENSEMBLE</a>
        <a class="nav-link" href="/page-admin/membres">MEMBRES</a>
        <a class="nav-link active" href="#">ACTUALITÉS</a>
    </div>
    <div class="container">
        <div class="nav flex-column nav-pills total" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="navbar-dark-brand" href="/">
                <a href="/">
                    <img src="/images/logo/logo-dark.png" width="90" height="90" alt="Logo du site">
                </a>
            </div>
            <a class="nav-link" href="/page-admin/vue-ensemble">VUE D'ENSEMBLE</a>
            <a class="nav-link" href="/page-admin/membres">MEMBRES</a>
            <a class="nav-link active" href="#">ACTUALITÉS</a>
        </div>
        <div class="tab-content" id="v-pills-tabContent" style="padding-bottom: 300px">
            <div class="tab-pane fade show active" id="v-pills-actu" role="tabpanel" aria-labelledby="v-pills-actu-tab">
                <h1 class="title lg text-center"> Actualités </h1>
                <hr class="line-under-title">

                <div class="actu-container">
                    <a class="title-actu" href="#" onclick="toggle('actu-1')">
                        Actualité 1 <i id="down-actu-1" class="fa fa-angle-down" aria-hidden="true"></i> <i id="up-actu-1" class="fa fa-angle-up" aria-hidden="true" style="display: none;"></i>
                    </a>
                    <div id="actu-1" style="display: none;">Formulaire à créer ici</div>

                    <a class="title-actu" href="#" onclick="toggle('actu-2')">
                        Actualité 2 <i id="down-actu-2" class="fa fa-angle-down" aria-hidden="true"></i> <i id="up-actu-2" class="fa fa-angle-up" aria-hidden="true" style="display: none;"></i>
                    </a>
                    <div id="actu-2" style="display: none;">Formulaire à créer ici</div>

                    <a class="title-actu" href="#" onclick="toggle('actu-3')">
                        Actualité 3 <i id="down-actu-3" class="fa fa-angle-down" aria-hidden="true"></i> <i id="up-actu-3" class="fa fa-angle-up" aria-hidden="true" style="display: none;"></i>
                    </a>
                    <div id="actu-3" style="display: none;">Formulaire à créer ici</div>

                    <a class="title-actu" href="#" onclick="toggle('actu-4')">
                        Actualité 4 <i id="down-actu-4" class="fa fa-angle-down" aria-hidden="true"></i> <i id="up-actu-4" class="fa fa-angle-up" aria-hidden="true" style="display: none;"></i>
                    </a>
                    <div id="actu-4" style="display: none;">Formulaire à créer ici</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection