@extends('layouts.layout')

@section('title', "ITS")

@section('breadcrumb')

@endsection

@section('content')

<!-- Carousel d'actualités -->
<section class="section" id="actu">
    <div id="carousel-actualite" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-actualite" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-actualite" data-slide-to="1"></li>
            <li data-target="#carousel-actualite" data-slide-to="2"></li>
            <li data-target="#carousel-actualite" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" height="100%">
            <div class="carousel-item active actu full-screen">
                <div class="carousel-caption">
                    <h1>Info Telecom Strasbourg</h1>
                    <br>
                    <p>Notre toute nouvelle association débarque à TPS</p>
                    <br>
                    <input class="favorite styled" value="Découvrir nos projets">
                </div>
            </div>
            <div class="carousel-item actu full-screen">
                <div class="carousel-caption">
                    <h1>Info Telecom Strasbourg</h1>
                    <br>
                    <p>Notre toute nouvelle association débarque à TPS</p>
                    <br>
                    <input class="favorite styled" value="Découvrir nos projets">
                </div>
            </div>
            <div class="carousel-item actu full-screen">
                <div class="carousel-caption">
                    <h1>Info Telecom Strasbourg</h1>
                    <br>
                    <p>Notre toute nouvelle association débarque à TPS</p>
                    <br>
                    <input class="favorite styled" value="Découvrir nos projets">
                </div>
            </div>
            <div class="carousel-item actu full-screen">
                <div class="carousel-caption">
                    <h1>Info Telecom Strasbourg</h1>
                    <br>
                    <p>Notre toute nouvelle association débarque à TPS</p>
                    <br>
                    <input class="favorite styled" type="button" value="Découvrir nos projets">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-actualite" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-actualite" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- Pôles d'activités -->
<section class="section" id="poles-activites">
    <h1 class="title lg text-center"> Nos pôles d'activités </h1>
    <hr class="line-under-title">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card" id="cours-container">
                <a class="card-img d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4" href="#">
                    <h3 class="text-white text-center" id="web">Cours & Accompagnement</h3>
                </a>
            </div>
            <div class="card" id="web-container">
                <a class="card-img d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4" href="#">
                    <h3 class="text-white text-center" id="web">Applications & Sites Web</h3>
                </a>
            </div>
            <div class="card" id="prog-container">
                <a class="card-img d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4" href="#">
                    <h3 class="text-white text-center" id="web">Programmation utilitaire</h3>
                </a>
            </div>
            <div class="card" id="compet-container">
                <a class="card-img d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4" href="#">
                    <h3 class="text-white text-center" id="web">Compétitions</h3>
                </a>
            </div>
            <div class="card" id="jeux-container">
                <a class="card-img d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4" href="#">
                    <h3 class="text-white text-center" id="web">Jeux vidéos</h3>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Nos projets -->
<section class="section grise" id="nos-projets">
    <h1 class="title lg text-center"> Nos projets </h1>
    <hr class="line-under-title">
    <div class="container-fluid text-center my-3">
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded">
                                <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                    <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                        accès à tous nos projets! (1)
                                    </p>
                                    <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded">
                                <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                    <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                        accès à tous nos projets! (2)
                                    </p>
                                    <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded">
                                <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                    <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                        accès à tous nos projets! (3)
                                    </p>
                                    <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded">
                                <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                    <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                        accès à tous nos projets! (4)
                                    </p>
                                    <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded">
                                <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                    <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                        accès à tous nos projets! (5)
                                    </p>
                                    <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded">
                                <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                    <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                        accès à tous nos projets! (6)
                                    </p>
                                    <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FPort_of_Spain&amp;src=Mmg5MnVjcGx1Nm9pNzRpNXAzM3UybG5naGtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23F6BF26&amp;showTitle=0&amp;showPrint=0&amp;showTabs=1&amp;showTz=0&amp;showCalendars=0" style="border:solid 1px #777" width="100%" height="600" frameborder="0" scrolling="no"></iframe> </div>
</section>

<!-- Notre association -->
<section class="section grise" id="association">
    <h1 class="title lg text-center"> Notre association </h1>
    <hr class="line-under-title">
    <div class="asso container-fluid">
        <div class="row justify-content-around">
            <div class="col-md-7" id="asso-txt">
                <p>
                    Cette année, une toute nouvelle association voit le jour dans ton école ! ITS te propose de découvrir le monde du numérique sous toutes ses formes.<br><br>
                    Au travers de 5 pôles, tu pourras développer des sites web et des applications, réaliser des petits programmes utiles, créer ton propre jeu PC, participer à de grandes compétitions informatiques, ou encore bénéficier de notre structure d'entraide.<br><br>
                    Si tu as besoin d'aide avec ton ordinateur, ou si tu souhaites obtenir de précieux conseils en programmation ou en cybersécurité, nous sommes aussi là pour toi !<br><br>
                    ITS c'est avant tout une association qui te permettra de progresser en informatique dans un cadre chaleureux et agréable. Et ceci, quel que soient ton niveau et tes objectifs.<br><br>
                    Alors n'hésite plus, ITS t'ouvre ses portes en Septembre pour ton plus grand bonheur !
                </p>
            </div>
            <div class="col-md-5" id="asso-img">
                <img src="/images/illustrations/tps.jpg" alt="Photo de TPS">
                <p>Ecole d'ingénieur Télécom Physique Strasbourg</p>
            </div>
        </div>
    </div>
</section>

<!-- Notre équipe -->
<section class="section" id="equipe">
    <h1 class="title lg text-center"> Notre équipe </h1>
    <hr class="line-under-title">
    <div class="respos">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Hugo LAULLIER </p>
                        <p id="fonction"> Président</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Gonçalo GIGA </p>
                        <p id="fonction"> Secrétaire</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Clara SCHILD </p>
                        <p id="fonction"> Trésorière</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Lucas SCHAEFFER </p>
                        <p id="fonction"> Responsable support</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Michael HOFMANN </p>
                        <p id="fonction"> Responsable <br> communication</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Yassine EL AIOUILLI </p>
                        <p id="fonction"> Responsable <br> sponsor</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Céline LY </p>
                        <p id="fonction"> Responsable <br> compétition</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Thomas RIVES </p>
                        <p id="fonction"> Responsable <br> programmation utilitaire</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Valentin COMPS </p>
                        <p id="fonction"> Responsable <br> applications et site web</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Idriss LARBI </p>
                        <p id="fonction"> Responsable jeux vidéo</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="respo">
                        <img class="profil-rounded" src="images/defaut/profil.jpg">
                        <p id="nom"> Clément ROSSETTI </p>
                        <p id="fonction"> Responsable consultant</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quelques chiffres -->
<section class="section grise" id="quelques-chiffres">
    <h1 class="title lg text-center"> Quelques chiffres </h1>
    <hr class="line-under-title">
    <div class="chiffres">
        <div class="chiffre">
            <h1>10</h1>
            PROJETS
        </div>
        <div class="chiffre">
            <h1>100</h1>
            MEMBRES
        </div>
        <div class="chiffre">
            <h1>5</h1>
            POLES
        </div>
        <div class="chiffre">
            <h1>1ère</h1>
            ANNEE
        </div>
    </div>
</section>

<!-- Le mot du directeur -->
<section class="section" id="mot-du-directeur">
    <h1 class="title lg text-center"> Le mot du Directeur </h1>
    <hr class="line-under-title">
    <div class="directeur">
        <h5> L’Association d’Informatique de Télécom Physique Strasbourg a tout mon soutien et je salue ses projets particulièrement ambitieux.<br><br>
            Ce projet associatif renforcera j’en suis certain l’entraide entre élèves-ingénieurs et par là même leur sentiment d’appartenance à une grande école d'ingénieurs.<br><br>
            Les 5 Pôles mis en place permettent aux élèves de mettre en pratique et compléter leur formation académique, que ce soit à travers le développement de programmes utiles, de jeux vidéo, d’applications mobiles ou de site Web.<br><br>
            J’encourage particulièrement la participation à des compétitions informatiques bénéfiques à la visibilité de Télécom Physique Strasbourg et de son Département Informatique et Réseaux.<br><br>Vous pourrez compter sur le soutien de votre directeur ! </h5>
        <img class="profil-rounded" src="/images/logo/collet.jpg">
        <p id="nom"> Christophe Collet </p>
        <p id="fonction">Directeur de l’école d’ingénieurs Télécom Physique Strasbourg</p>
    </div>
</section>

<!-- Partenariat -->
<section class="section grise" id="partenariat">
    <h1 class="title lg text-center"> Nos collaborateurs </h1>
    <hr class="line-under-title">
    <div class="partenaires">
        <div class="partenaire">
            <a href="https://physique-ingenierie.fr/" class="logo" id="psi">
                <img class="logo-pres" src="/images/logo/psi.png" alt="Logo de PSI">
                <p>PSI Junior-Entreprise</p>
            </a>
        </div>

        <div class="partenaire">
            <a href="http://www.telecom-physique.fr/" class="logo" id="tps">

                <img class="logo-pres" src="/images/logo/tps.png" alt="Logo de TPS">
                <p>Télécom Physique Strasbourg</p>
            </a>
        </div>

        <div class="partenaire">
            <a href="https://robot-ps.com/" class="logo" id="rts">
                <img class="logo-pres" src="/images/logo/rts.png" alt="Logo de RTS">
                <p>Robot Télécom Strasbourg</p>
            </a>
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
                <form class="contact-form d-flex flex-column align-items-center" action="https://formspree.io/youremail@mail.com" method="POST">
                    <div class="form-group" style="width: 100%;">
                        <input type="name" class="form-control" placeholder="Nom" name="name" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input type="email" class="form-control" placeholder="Email" name="name" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Objet" name="objet" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <textarea class="form-control" type="text" placeholder="Message" rows="9" name="name" style="resize: none;" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-rounded btn-primary" style="width: 200px;">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection