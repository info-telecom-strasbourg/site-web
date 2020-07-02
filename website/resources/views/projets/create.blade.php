@extends('layouts.layout')

@section('title', 'Création d\'un projet')

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
        <form action="/projets" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="form-title-small">Titre</label>

                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc" class="form-title-small">Description</label>

                <textarea class="form-control @error('desc') is-invalid @enderror desc" id="desc" name="desc" rows="5" required>{{ old('desc') }}</textarea>


                @error('desc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="pole_id" class="form-title-small">Pôle</label>
                <select class="custom-select @error('pole_id') is-invalid @enderror" id="pole_id" name="pole_id" required>
                    <option selected readonly>Choisir un pôle ...</option>
                    
                    @isset($poles)

                        @foreach ($poles as $pole)
                            <option value="{{ $pole->id }}" @if (old('pole_id') == $pole->id) selected @endif>{{ $pole->title }}</option>
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
                <label for="chef_projet_id" class="form-title-small">Chef de projet</label>
                <select class="custom-select @error('chef_projet_id') is-invalid @enderror" id="chef_projet_id" name="chef_projet_id" required>
                    <option selected readonly>Choisir un chef de projet ...</option>
                    
                    @isset($users)

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if (old('chef_projet_id') == $user->id) selected @endif>{{ $user->name }}</option>
                        @endforeach

                    @endisset

                </select>

                @error('chef_projet_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez un chef de projet</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="participants" class="form-title-small">Participants</label>
                <select class="custom-select @error('participants') is-invalid @enderror" id="participants" name="participants[]" multiple>                    
                    @isset($users)

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach

                    @endisset

                </select>

                @error('participants')
                    <span class="invalid-feedback" role="alert">
                        <strong>Choisissez des participans</strong>
                    </span>
                @enderror
            </div>
            <div class="custom-control custom-checkbox" style="margin-bottom: 1rem;">
                <input id="complete" type="checkbox" class="custom-control-input" name="complete" value="1">

                <label class="custom-control-label form-title-small" for="complete">Projet compléter</label>
            </div>
            <div class="form-group">
                <label class="title lg text-left form-title-small">
                    Images
                </label>
                <br>

                <input type="file" id="images" name="images[]" multiple>
            </div>
            <h4 class="form-title">Liens</h4>
            <div class="form-group">
                <label class="sr-only" for="link_github">Lien du repository GitHub</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">                
                        <i class="fab fa-github" style="font-size: 1rem;"></i>
                    </div>
                </div>
                    <input type="url" class="form-control @error('link_github') is-invalid @enderror" id="link_github" name="link_github" placeholder="Lien du repository GitHub" value="{{ old('link_github') }}">
                    
                    @error('link_github')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="sr-only" for="link_doc">Lien vers la documentation</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                    <input type="url" class="form-control @error('link_doc') is-invalid @enderror" id="link_doc" name="link_doc" placeholder="Lien vers la documentation"value="{{ old('link_doc') }}">
                    
                    @error('link_doc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="sr-only" for="link_download">Lien pour le téléchargement</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-download"></i>
                    </div>
                </div>
                    <input type="url" class="form-control @error('link_download') is-invalid @enderror" id="link_download" name="link_download" placeholder="Lien pour le téléchargement" value="{{ old('link_download') }}">

                    @error('link_download')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                <button type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
            </div>
        </form>
    </div>
</div>
@endsection