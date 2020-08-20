<!-- "Besoin d'aide" page -->
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

    <audio id="asterix" src="audio/asterix.mp3" style="display: none;"></audio>

    <div id="asterix_1">
        <div style="display: flex; justify-content:center; flex-direction:column;">
            <div style="margin: 5px auto 10px auto;">
                Avez-vous vraiment besoin d'aide?
            </div>
            <div style="margin: auto;">
                <button onclick="play()" type="button" style="margin: 0 20px">Oui</button>
                <button onclick="hide()" type="button" style="margin: 0 20px">Non</button>
            </div>
        </div>
    </div>
    <div id="asterix_2">
        <div style="display: flex; justify-content:center; flex-direction:column;">
            <div style="margin: 5px auto 10px auto;">
                Allez-vous mieux?
            </div style="margin: auto;">
            <div style="margin: auto;">
                <button onclick="stop()" type="button">Oui</button>
            </div>
        </div>
    </div>

    <div class="container pt-3">
        <!-- Check if the user is connected -->
        @guest
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 50px">
            Veuillez-vous <strong><a href="/login">connecter</a></strong> pour accéder à ce service.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @else

        <!-- Confirmation email was sent -->
        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- Form for the request -->
        <form action="/besoin-aide" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- The type of the request -->
            <div class="form-group">
                <label for="type" class="form-title-small">
                    Type de demande
                </label>
                <select class="form-control" id="type" name="type">
                    <option>Connexion Wi-Fi Eduroam automatique</option>
                    <option>Synchronisation boîte mail Unistra sur boîte mail perso</option>
                    <option>Besoin d'une machine virtuelle</option>
                    <option>Problème avec un logiciel</option>
                    <option>Fichiers supprimés par erreur</option>
                    <option>Problème avec le terminal</option>
                    <option>Utilisation git</option>
                    <option>Autre</option>
                </select>
            </div>

            <!-- The type of the device -->
            <div class="form-group">
                <label for="appareil" class="form-title-small">
                    Appareil
                </label>
                <select class="form-control" id="appareil" name="appareil" class="form-title-small">
                    <option>Ordinateur</option>
                    <option>Téléphone</option>
                </select>
            </div>

            <!-- The type of the operating system -->
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

            <!-- Files linked to the request -->
            <div class="form-group">
                <label for="files" class="form-title-small">Fichiers</label>
                <input type="file" class="form-control-file" id="files" name="files[]" multiple>
            </div>

            <!-- Description of the request -->
            <div class="form-group">
                <label for="desc" class="form-title-small">Description de la demande</label>
                <textarea class="form-control" type="text" placeholder="Message" rows="9" id="desc" name="desc" style="resize: none;" required></textarea>
            </div>

            <!-- Button to send the request -->
            <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                <button type="submit" class="btn btn-primary btn-rounded">Envoyer</button>
            </div>
        </form>
        @endguest
    </div>
</div>

<style>
    #asterix_1 {
        display: none;
    }

    #asterix_2 {
        display: none;
    }
</style>

<script src="url de keypress-2.0.3.min.js"></script>
<script>
    var sound = document.getElementById("asterix");
    if (sound.duration == sound.currentTime)
        document.getElementById("asterix_2").style.display = "none";

    function hide() {
        document.getElementById("asterix_1").style.display = "none";
    }


    function play() {
        sound.currentTime = 0;
        sound.play();
        document.getElementById("asterix_1").style.display = "none";
        document.getElementById("asterix_2").style.display = "block";
    }


    function stop() {
        sound.pause();
        document.getElementById("asterix_2").style.display = "none";
    }

    //Detect "help"
    var k = [72, 69, 76, 80],
        n = 0;
    $(document).keydown(function(e) {
        if (e.keyCode === k[n++]) {
            if (n === k.length) {
                if (document.getElementById("asterix_2").style.display != "block")
                    document.getElementById("asterix_1").style.display = "block";
                n = 0;
                return false;
            }
        } else {
            n = 0;
        }
    });
</script>

@endsection