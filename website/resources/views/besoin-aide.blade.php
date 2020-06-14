@extends('layouts.layout')

@section('title', "ITS")

@section('breadcrumb')

@endsection

@section('content')

<section id="besoin-aide">
    <h1 class="title lg text-center"> Besoin d'aide </h1>
    <hr class="line-under-title">
    <div class="formulaire-besoin-aide">
        <form class="contact-form d-flex flex-column align-items-center" action="https://formspree.io/youremail@mail.com" method="POST">
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlSelect1">Type de demande</label>
                <select class="form-control" id="exampleFormControlSelect1">
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
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlSelect1">Appareil</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Ordinateur</option>
                    <option>Téléphone</option>
                </select>
            </div>
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlSelect1">Système d'exploitation</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Linux</option>
                    <option>Windows</option>
                    <option>Android</option>
                    <option>iOS</option>
                </select>
            </div>
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlFile1">Images</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group" style="width: 100%;">
            <label for="exampleFormControlFile1">Description de la demande</label>
                <textarea class="form-control" type="text" placeholder="Message" rows="9" name="name" style="resize: none;" required></textarea>
            </div>
            <button type="submit" class="btn btn-rounded btn-primary" style="width: 200px;">Envoyer</button>
        </form>
    </div>
</section>


@endsection