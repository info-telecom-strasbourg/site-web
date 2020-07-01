@extends('layouts.layout')

@section('title', 'Liste des membres')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/projets">Projets</a></li>
<li class="breadcrumb-item active">Création</li>
@endsection

@section('content')

<div class="container">
    <h1 class="title lg text-center">
        Création d'un projet
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/projets" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titre</label>

                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc">Description</label>

                <textarea class="form-control @error('desc') is-invalid @enderror desc" id="desc" name="desc" rows="5" required>{{ old('desc') }}</textarea>


                @error('desc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="pole_id">Pôle</label>
                <select class="custom-select" id="pole_id" name="pole_id" required>
                    <option selected readonly>Choisir un pôle ...</option>
                    
                    @isset($poles)

                        @foreach ($poles as $pole)
                            <option value="{{ $pole->id }}">{{ $pole->title }}</option>
                        @endforeach

                    @endisset

                </select>

                @error('pole_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez un pôle</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="chef_projet_id">Chef de projet</label>
                <select class="custom-select" id="chef_projet_id" name="chef_projet_id" required>
                    <option selected readonly>Choisir un chef de projet ...</option>
                    
                    @isset($users)

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach

                    @endisset

                </select>

                @error('chef_projet_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez un chef de projet</strong>
                    </span>
                @enderror
            </div>
            <div class="custom-control custom-checkbox" style="margin-bottom: 1rem;">
                <input id="complete-status" type="checkbox" class="custom-control-input" name="complete" value="1">

                <label class="custom-control-label" for="complete">Projet compléter</label>


                @error('complete')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="title lg text-left">
                    Images
                </label>
                <br>

                <input type="file" id="images" name="images[]" multiple>
            </div>
            <h4>Liens</h4>
            <div class="form-group">
                <label class="sr-only" for="link_github">Lien du repository GitHub</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">                
                        <i class="fab fa-github" style="font-size: 1rem;"></i>
                    </div>
                </div>
                    <input type="text" class="form-control" id="link_github" name="link_github" placeholder="Lien du repository GitHub">
                </div>

                @error('link_github')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="sr-only" for="link_doc">Lien vers la documentation</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                    <input type="text" class="form-control" id="link_doc" name="link_doc" placeholder="Lien vers la documentation">
                </div>

                @error('link_doc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="sr-only" for="link_download">Lien pour le téléchargement</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-download"></i>
                    </div>
                </div>
                    <input type="text" class="form-control" id="link_download" name="link_download" placeholder="Lien pour le téléchargement">
                </div>

                @error('link_download')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
        </form>
    </div>
</div>
@endsection