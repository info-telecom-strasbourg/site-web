<!-- Edit a project -->

@extends('layouts.layout')

@section('title', 'Édition d\'un projet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="/projets">Projets</a></li>
    <li class="breadcrumb-item"><a href="/projets/{{ $projet->id }}">{{ $projet->title }}</a></li>
    <li class="breadcrumb-item active">Création</li>
@endsection

@section('content')

    <div class="container">
        <h1 class="title lg text-center">
            Édition du projet : {{ $projet->title }}
        </h1>
        <hr class="line-under-title">

        <div class="container pt-3">
            <form action="/projets/{{ $projet->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title of the project -->
                <div class="form-group">
                    <label for="title" class="form-title-small">Titre</label>

                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ $projet->title }}" required autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Description of the project -->
                <div class="form-group">
                    <label for="desc" class="form-title-small">Description</label>

                    <textarea class="form-control @error('desc') is-invalid @enderror desc" id="desc" name="desc" rows="5"
                        required>{{ $projet->desc }}</textarea>


                    @error('desc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Pole of the project -->
                <div class="form-group">
                    <label for="pole_id" class="form-title-small @error('pole_id') is-invalid @enderror">Pôle</label>
                    <select class="custom-select" id="pole_id" name="pole_id" required>
                        <option selected readonly>Choisir un pôle ...</option>

                        @isset($poles)

                            @foreach ($poles as $pole)
                                <option value="{{ $pole->id }}" @if ($projet->pole_id == $pole->id) selected
                            @endif>{{ $pole->title }}</option>
                            @endforeach

                        @endisset

                    </select>

                    @error('pole_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez un pôle</strong>
                    </span>
                    @enderror
                </div>

                <!-- Leader of the project -->
                <div class="form-group">
                    <label for="chef_projet_id" class="form-title-small">Chef de projet</label>
                    <select class="custom-select @error('chef_projet_id') is-invalid @enderror" id="chef_projet_id"
                        name="chef_projet_id" required>
                        <option selected readonly>Choisir un chef de projet ...</option>

                        @isset($users)

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($projet->chef_projet_id == $user->id) selected
                            @endif>{{ $user->name }}</option>
                            @endforeach

                        @endisset

                    </select>

                    @error('chef_projet_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez un chef de projet</strong>
                    </span>
                    @enderror
                </div>

                <!-- Other contributors of the project -->
                <div class="form-group">
                    <label for="participants" class="form-title-small">Ajouter des participants</label>
                    <select class="custom-select @error('participants') is-invalid @enderror" id="participants"
                        name="participants[]" multiple>
                        @isset($users)
                            @foreach ($users as $user)
                                @if (!$projet->participants->contains($user->id))
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach

                        @endisset

                    </select>

                    @error('participants')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez des participans</strong>
                    </span>
                    @enderror
                </div>

                <!-- Stage of the project -->
                <div class="custom-control custom-checkbox" style="margin-bottom: 1rem;">
                    <input id="complete-status" type="checkbox" class="custom-control-input" name="complete" @if ($projet->complete == 1) checked="checked" @endif
                    value="1">

                    <label class="custom-control-label form-title-small" for="complete">Projet compléter</label>
                </div>

                <!-- Images of the project -->
                <div class="form-group">
                    <label class="title lg text-left form-title-small">
                        Images
                    </label>
                    <br>

                    <input type="file" id="images" name="images[]" multiple>
                </div>
                <h4 class="form-title">Cochez les images à supprimer</h4>
                <div class="form-group row align-items-center">
                    @foreach (json_decode($projet->images) as $key => $image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $image) }}" alt=" {{ $key }} slide"
                                style="height: 100px !important;">
                            <input type="checkbox" name="removeImages[{{ $key }}]" value="1">
                        </div>
                    @endforeach
                </div>
                <h4 class="form-title">Liens</h4>

                <!-- Link Github of the project -->
                <div class="form-group">
                    <label class="sr-only" for="link_github">Lien du repository GitHub</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fab fa-github" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                        <input type="url" class="form-control @error('link_github') is-invalid @enderror" id="link_github"
                            name="link_github" placeholder="Lien du repository GitHub" value="{{ $projet->link_github }}">

                        @error('link_github')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Link to download the documentation of the project -->
                <div class="form-group">
                    <label class="sr-only" for="link_doc">Lien vers la documentation</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        </div>
                        <input type="url" class="form-control @error('link_doc') is-invalid @enderror" id="link_doc"
                            name="link_doc" placeholder="Lien vers la documentation" value="{{ $projet->link_doc }}">

                        @error('link_doc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Link to download the project -->
                <div class="form-group">
                    <label class="sr-only" for="link_download">Lien pour le téléchargement</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-download"></i>
                            </div>
                        </div>
                        <input type="url" class="form-control @error('link_download') is-invalid @enderror"
                            id="link_download" name="link_download" placeholder="Lien pour le téléchargement"
                            value="<beautify start=" @if " exp=" ^^^!empty($projet->link_download)^^^">
                        {{ $projet->link_download }} @endif">

                        @error('link_download')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Button to edit the project -->
                <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                    <button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
