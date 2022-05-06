<!-- Welcome page -->
@extends('layouts.layout')

@section('title', 'ITS')

@section('content')

<!-- Carousel of the news -->
<section class="section" id="actu">
    <div id="carousel-actualite" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
			@if($allNews->count() > 1)
            @foreach($allNews as $news)
            	<li data-target="#carousel-actualite" data-slide-to="{{ $news->position - 1 }}"  @if($news->position == 1) class="active" @endif></li>
            @endforeach
			@endif
        </ol>
        <div class="carousel-inner" height="100%">
            @forelse($allNews as $news)
	            <div class="carousel-item actu @if($news->position == 1) active @endif full-screen" style="background: url({{ asset('storage/' . $news->image) }}) top center; background-size: cover;">
	                <div class="carousel-caption">
	                    <h1>{{ $news->title }}</h1>
	                    <br>
	                    <p>{{ $news->desc }}</p>
	                    <br>
	                    @isset($news->button)
	                    @isset($news->link)
	                    <form action="{{ $news->link }}">
	                        <input class="favorite styled" type="submit" value="{{ $news->button }}">
	                    </form>
	                    @endisset
	                    @endisset
	                </div>
                </div>
			@empty
				<div class="carousel-item actu active full-screen" style="background: url({{ asset('storage/' . $defaultNews->image) }}) top center; background-size: cover;">
				<div class="carousel-caption">
					<h1>{{ $defaultNews->title }}</h1>
	                    <br>
	                    <p>{{ $defaultNews->desc }}</p>
	                    <br>
	                    @isset($defaultNews->button)
	                    @isset($defaultNews->link)
	                    <form action="{{ $defaultNews->link }}">
	                        <input class="favorite styled" type="submit" value="{{ $defaultNews->button }}">
	                    </form>
	                    @endisset
	                    @endisset
				</div>
				</div>
            @endforelse
            </div>

            @if($allNews->count() > 1)
            <!-- Arrow to go to the previous new -->
            <a class="carousel-control-prev" href="#carousel-actualite" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Arrow to go to the next new -->
            <a class="carousel-control-next" href="#carousel-actualite" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            @endif
        </div>
</section>

<!-- Poles -->
<section class="section" id="poles-activites">
    <h1 class="title lg text-center"> Nos pôles d'activités </h1>
    <hr class="line-under-title">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach ($poles as $pole)
            <div class="card" style="background-image: url({{ asset('storage/' . $pole->image) }})">
                <a class="card-img d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4" href="/poles/{{ $pole->slug }}">
                    <h3 class="text-white text-center" id="web">{{ $pole->title }}</h3>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Carousel of random projects -->
<section class="section grise" id="nos-projets">
    <h1 class="title lg text-center"> Nos projets </h1>
    <hr class="line-under-title">
    <div class="container-fluid text-center my-3">
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    @foreach ($projets as $projet)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="col-md-4">
                                <div class="card custom-card text-center shadow mb-5 bg-white rounded">
                                    <img class="card-img-top" src="{{ asset('storage/' . json_decode($projet->projet->images)[0]) }}" alt="Card image cap">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center font-weight-bold">{{ $projet->projet->title }}</h5>
                                        <p class="card-text">{{ mb_strlen( $projet->projet->desc ) > 57 ? mb_substr($projet->projet->desc, 0, 54) . ' ...' : $projet->projet->desc }}
                                        </p>
                                        <a href="/projets/{{ $projet->projet_id }}" class="btn btn-rounded btn-primary">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Agenda -->
<section class="section" id="agenda">
    <h1 class="title lg text-center"> Agenda </h1>
    <hr class="line-under-title">
    <div class="google-agenda">
        <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Europe%2FParis&amp;src=Mmg5MnVjcGx1Nm9pNzRpNXAzM3UybG5naGtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23F6BF26&amp;showTitle=0&amp;showPrint=0&amp;showTabs=1&amp;showTz=0&amp;showCalendars=0" style="border:solid 1px #777" width="400px" height="600" frameborder="0" scrolling="no" id="agenda-frame"></iframe> </div>
</section>

<!-- Our association -->
<section class="section grise" id="association">
    <h1 class="title lg text-center"> Notre association </h1>
    <hr class="line-under-title">
    <div class="asso container-fluid">
        <div class="row justify-content-around">
            <div class="col-md-7" id="asso-txt">
                <p>
                    ITS te propose de découvrir le monde du numérique sous toutes ses formes.<br><br>
                    Au travers de 5 pôles, tu pourras développer des sites web et des applications, réaliser des petits programmes utiles, créer ton propre jeu vidéo, participer à de grandes compétitions informatiques, ou encore bénéficier de notre structure d'entraide.<br><br>
                    Si tu as besoin d'aide avec ton ordinateur, ou si tu souhaites obtenir de précieux conseils en programmation ou en cybersécurité, nous sommes aussi là pour toi !<br><br>
                    ITS c'est avant tout une association qui te permettra de progresser en informatique dans un cadre chaleureux et agréable. Et ceci, quels que soient ton niveau et tes objectifs.<br><br>
                    Alors n'hésite plus, ITS t'ouvre ses portes en Septembre pour ton plus grand bonheur ! 
                </p>
            </div>
            <div class="col-md-5" id="asso-img">
                <img src="/images/illustrations/tps.jpg" alt="Photo de TPS">
                <p>École d'ingénieur Télécom Physique Strasbourg</p>
            </div>
        </div>
    </div>
</section>

<!-- Our team -->
<section class="section" id="equipe">
    <h1 class="title lg text-center"> Notre équipe </h1>
    <hr class="line-under-title">
    <div class="respos">
        <div class="container-fluid">
            <div class="row">
                @foreach ($team as $user)
                <div class="col-md-3 text-center">
                    <a href="/users/{{ $user->id }}" class="respo">
                        <img class="profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}">
                        <p id="nom">{{ $user->name }}</p>
                        <p id="fonction">{{ $user->role->role }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Some figures -->
<section class="section grise" id="quelques-chiffres">
    <h1 class="title lg text-center"> Quelques chiffres </h1>
    <hr class="line-under-title">
    <div class="chiffres">
        <div class="chiffre">
            <h1>{{ $nbProjets }}</h1>
            PROJETS
        </div>
        <div class="chiffre">
            <h1>{{ $nbUsers }}</h1>
            MEMBRES
        </div>
        <div class="chiffre">
            <h1>{{ $nbPoles }}</h1>
            PÔLES
        </div>
        <div class="chiffre">
            @if ($years == 1)
            <h1>{{ $years }}ère</h1>
            @else
            <h1>{{ $years }}ème</h1>
            @endif
            ANNÉE
        </div>
    </div>
</section>

<!-- A word from the director -->
<section class="section" id="mot-du-directeur">
    <h1 class="title lg text-center"> Le mot du Directeur </h1>
    <hr class="line-under-title">
    <div class="directeur">
        <p style="font-style: italic;"> "L’Association d’Informatique de Télécom Physique Strasbourg a tout mon soutien et je salue ses projets particulièrement ambitieux.<br><br>
            Ce projet associatif renforcera j’en suis certain l’entraide entre élèves-ingénieurs et par là même leur sentiment d’appartenance à une grande école d'ingénieurs.<br><br>
            Les 5 pôles mis en place permettent aux élèves de mettre en pratique et compléter leur formation académique, que ce soit à travers le développement de programmes utiles, de jeux vidéo, d’applications mobiles ou de site Web.<br><br>
            J’encourage particulièrement la participation à des compétitions informatiques bénéfiques à la visibilité de Télécom Physique Strasbourg et de son département Informatique et Réseaux.<br><br>Vous pourrez compter sur le soutien de votre directeur !"</p>
        <img class="profil-rounded" src="/images/illustrations/collet.jpg">
        <p id="nom"> Christophe Collet </p>
        <p id="fonction">Directeur de l’école d’ingénieur Télécom Physique Strasbourg</p>
    </div>
</section>

<!-- Collaboration -->
<section class="section grise" id="partenariat">
    <h1 class="title lg text-center"> Nos collaborateurs </h1>
    <hr class="line-under-title">
    <div class="container-fluid">
        <div class="row align-items-end justify-content-around">
            @foreach($partners as $partner)
            <div class="col-auto">
                <a href="{{ $partner->link }}" class="logo" target="_blank">
                    <div style="height: 150px;" class="row align-items-center">
                        <img class="logo-pres" src="{{ asset($partner->image) }}" alt="Logo de {{ $partner->name }}">
                    </div>
                    <p>{{ $partner->name }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <a id="contact-anchor"></a>
</section>

<!-- Contact -->
<section class="section p-4 p-lg-5 text-center" id="contact">
    <h1 class="title lg text-center"> Contact </h1>
    <hr class="line-under-title">
    <div class="container-fluid">
        <div class="row" style="justify-content: space-around;">
            <div id="gmap" class="col-md-5 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s" style="max-width: 600px">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2642.3720999403968!2d7.7347999514380845!3d48.52610033189745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796ca33e265b8bf%3A0x3a9eb5576462d5e3!2sT%C3%A9l%C3%A9com%20Physique%20Strasbourg!5e0!3m2!1sfr!2sfr!4v1591805091984!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div id="contact_cont" class="contact-form col-md-5">
                <!-- Confirmation email was sent -->
                @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form class="contact-form d-flex flex-column align-items-center" action="/contact" method="POST">
                    @csrf
                    <div class="form-group" style="width: 100%;">
                        <input type="name" class="form-control" placeholder="Nom" name="name" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input type="email" class="form-control" placeholder="Email" name="email" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Objet" name="subject" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <textarea class="form-control" type="text" placeholder="Message" rows="9" name="messages" style="resize: none;" required></textarea>
                    </div>
                    <x-honey/>
                    <button type="submit" class="btn btn-rounded btn-primary" style="width: 200px;">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection