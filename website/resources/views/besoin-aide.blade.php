@extends('layouts.layout')

@section('title', 'Besoin d\'aide')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Besoin d'aide</li>
@endsection

@section('content')

<div class="container">
    <h1 class="title lg text-center"> 
        Besoin d'aide
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        @guest
            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 50px">
                Veuillez-vous <strong><a href="/login">connecter</a></strong> pour accéder à ce service.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else
        <!-- Confirmtion email was send -->
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="/besoin-aide" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="type" class="form-title-small">
                        Type de demande
                    </label>
                    <select class="form-control" id="type" name="type">
                        <option>Connexion Wi-Fi Eduroam automatique</option>
                        <option>Synconisation boîte mail Unistra sur boîte mail perso</option>
                        <option>Besoin d'une machine virtuelle</option>
                        <option>Problème avec un logiciel</option>
                        <option>Fichiers supprimés par erreur</option>
                        <option>Problème avec le terminal</option>
                        <option>Utilisation git</option>
                        <option>Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="appareil" class="form-title-small">
                        Appareil
                    </label>
                    <select class="form-control" id="appareil" name="appareil" class="form-title-small">
                        <option>Ordinateur</option>
                        <option>Téléphone</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="os" class="form-title-small">
                        Système d'exploitation
                    </label>
                    <select class="form-control" id="os" name="os">
                        <option>MacOS</option>
                        <option>Linux</option>
                        <option>Windows</option>
                        <option>Android</option>
                        <option>iOS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="files" class="form-title-small">Fichiers</label>
                    <input type="file" class="form-control-file" id="files" name="files[]" multiple>
                </div>
                <div class="form-group">
                    <label for="desc" class="form-title-small">Description de la demande</label>
                    <textarea class="form-control" type="text" placeholder="Message" rows="9" id="desc" name="desc" style="resize: none;" required></textarea>
                </div>

                <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                    <button type="submit" class="btn btn-primary btn-rounded">Envoyer</button>
                </div>
            </form>
        @endguest
    </div>
</div>


@endsection