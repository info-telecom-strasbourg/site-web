<!-- Display a user -->

@extends('layouts.layout')

@section('title', 'Membres ITS - '. $user->name)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/users">Membres</a></li>
<li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')

<div class="container">

    <!-- Name of the user -->
    <h1 class="title lg text-center">
        {{ $user->name }}
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <div class="row justify-content-around">
            <!-- Edit profil information -->
            <div class="col-md-4">
                <div class="row justify-content-center align-items-center flex-column profil-card profil-edit">

                    <!-- Profil image badge -->
                    <img class="profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}" />
                    <div class="rank-label-container">
                        Modifier
                    </div>

                    <form action="" id="form-profil-edit">
                        <!-- User's name -->
                        <div class="input-group">
                            <input type="text" class="custom-form-control form-control" id="name" name="name"
                                placeholder="Nom" value="{{ $user->name }}">
                        </div>

                        <!-- User's Email address -->
                        <div class="input-group">
                            <input type="email" class="custom-form-control form-control" id="email" name="email"
                                placeholder="Adresse e-mail" value="{{ $user->email }}">
                        </div>

                        <!-- Password -->
                        <div class="input-group">
                            <input type="password"
                                class="custom-form-control form-control pwd @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Nouveau mot de passe" data-toggle="tooltip"
                                data-placement="top" title="Ne rien mettre pour garder l'ancien mot de passe.">
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button"><i
                                        class="eye-icon far fa-eye"></i></button>
                            </span>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Confirm password -->
                        <div class="input-group">
                            <input type="password" class="custom-form-control form-control pwd-confirm"
                                id="confirmPassword" name="confirmPassword" placeholder="Nouveau mot de passe">
                            <span class="input-group-btn">
                                <button class="btn reveal-confirm" type="button"><i
                                        class="eye-icon-confirm far fa-eye"></i></button>
                            </span>
                        </div>

                        <!-- Button to edit the profil information -->
                        <div class="text-center" style="margin-top:25px;">
                            <button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <!-- List all projects of the current user-->
                <div class="row flex-column profil-card">
                    <div class="profil-card-header row justify-content-between align-items-center">
                        <h6 class="text-center" style="margin-bottom: 0;">Mes projets</h6>

                        <!-- Search bar -->
                        <form class="form-inline d-flex justify-content-center md-form form-sm"
                            style="flex-flow: nowrap;">
                            <input class="custom-form-control profil-search disabled" type="text" id="search-projet"
                                name="search" placeholder="Search..." aria-label="Search">
                            <i class="search-button fas fa-search" aria-hidden="true"></i>
                        </form>
                    </div>

                    <div class="profil-card-body overflow-auto">
                    </div>
                </div>

                <!-- List all lessons the current user created -->
                <div class="row flex-column profil-card">
                    <div class="profil-card-header row justify-content-between align-items-center">
                        <h6 class="text-center" style="margin-bottom: 0;">Mes cours</h6>

                        <form class="form-inline d-flex justify-content-center md-form form-sm"
                            style="flex-flow: nowrap;">
                            <!-- Search bar -->
                            <input class="custom-form-control profil-search profil-search-cours disabled" type="text" id="search-cours"
                                name="search" placeholder="Search..." aria-label="Search">
                            <i class="search-button-cours fas fa-search" aria-hidden="true"></i>

                            <!-- Add new lesson button -->
                            @can ('create', 'App\Cours')
                                <a class="btn btn-primary btn-rounded add-cours" href="/poles/cours/create"><i class="fas fa-plus"></i></a>
                            @endcan
                        </form>


                    </div>

                    <div class="profil-card-body overflow-auto">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <!-- List all competitions the current user attends -->
                <div class="row flex-column profil-card profil-show-cours">
                    <div class="profil-card-header row justify-content-between align-items-center">
                        <h6 class="text-center" style="margin-bottom: 0;">Mes compétitions</h6>

                        <!-- Search bar -->
                        <form class="form-inline d-flex justify-content-center md-form form-sm"
                            style="flex-flow: nowrap;">
                            <input class="custom-form-control profil-search disabled" type="text" id="search-compet"
                                name="search" placeholder="Search..." aria-label="Search">
                            <i class="search-button fas fa-search" aria-hidden="true"></i>
                        </form>
                    </div>

                    <div class="profil-card-body overflow-auto">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection