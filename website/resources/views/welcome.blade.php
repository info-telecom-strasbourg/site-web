@extends('layouts.layout')

@section('title', "ITS")

@section('breadcrumb')

@endsection

@section('content')


<section id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner" height="100%">
        <div class="carousel-item active actu full-screen">
            <div class="carousel-caption">
                <h1>Info Telecom Strasbourg</h1>
                <br>
                <p>Notre toute nouvelle association débarque à TPS</p>
                <br>
                <input class="favorite styled" type="button" value="Découvrir nos projets">
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
        <div class="carousel-item actu full-screen">
            <div class="carousel-caption">
                <h1>Info Telecom Strasbourg</h1>
                <br>
                <p>Notre toute nouvelle association débarque à TPS</p>
                <br>
                <input class="favorite styled" type="button" value="Découvrir nos projets">
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
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>

<section class="section" id="poles-activites">
    <br>
    <br>
    <h1 class="title lg text-center"> Nos pôles d'activités </h1>
    <hr class="line-under-title">
    <div class="activites">
            <a id="cours" href="#" class="btn btn-primary">Cours & Accompagnements</a>
            <a id="web" href="#" class="btn btn-primary">Applications & Sites Web</a>
            <a id="prog" href="#" class="btn btn-primary">Programmation utilitaire</a>
            <a id="compet" href="#" class="btn btn-primary">Compétitions</a>
            <a id="jeux" href="#" class="btn btn-primary">Jeux Vidéos</a>
    </div>
</section>

<section class="section grise" id="nos-projets">
    <br>
    <br>
    <h1 class="title lg text-center"> Nos derniers projets </h1>
    <hr class="line-under-title">
    <br>
    <br>
    <div class="container text-center my-3">
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-md-4">
                            <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem; margin: auto;">
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
                            <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem; margin: auto;">
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
                            <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem; margin: auto;">
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
                            <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem; margin: auto;">
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
                            <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem; margin: auto;">
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
                            <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem; margin: auto;">
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
    <br>
    <br>
</section>


<section class="section" id="agenda">
    <br>
    <br>
    <h1 class="title lg text-center"> Agenda </h1>
    <hr class="line-under-title">
    <br>
    <br>
    <div class="google-agenda">
        <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FPort_of_Spain&amp;src=aW5mby50ZWxlY29tLnN0cmFzYm91cmdAZ21haWwuY29t&amp;color=%23E67C73&amp;showTitle=0&amp;showPrint=0&amp;showDate=1&amp;showTabs=1&amp;showCalendars=0&amp;showTz=0" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe> </div>
    <br>
    <br>
</section>

<section class="section grise" id="quelques-chiffres">
    <br>
    <br>
    <h1 class="title lg text-center"> Quelques chiffres </h1>
    <hr class="line-under-title">
    <br>
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
            <h1>1ère</h1>
            ANNEE
        </div>
        <div class="chiffre">
            <h1>10</h1>
            PROJETS
        </div>
    </div>
    <br>
</section>

<section class="section" id="equipe">
    <br>
    <br>
    <h1 class="title lg text-center"> Notre équipe </h1>
    <hr class="line-under-title">
    <div class="respos">
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Hugo Laullier </p>
            <p id="fonction"> Président</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Gonçalo Giga </p>
            <p id="fonction"> Secrétaire</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Clara Schild </p>
            <p id="fonction"> Trésorière</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Lucas Schaeffer </p>
            <p id="fonction"> Responsable support</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Michael Hofmann </p>
            <p id="fonction"> Responsable <br> communication</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Yassine El Aiouilli </p>
            <p id="fonction"> Responsable <br> sponsor</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Céline Ly </p>
            <p id="fonction"> Responsable <br> compétition</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Thomas Rives </p>
            <p id="fonction"> Responsable <br> programmation utilitaire</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Valentin Comps </p>
            <p id="fonction"> Responsable <br> applications et site web</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Idriss Larbi </p>
            <p id="fonction"> Responsable jeux vidéo</p>
        </a>
        <a href="#" class="respo">
            <img class="profil-rounded" src="images/defaut/profil.jpg">
            <p id="nom"> Clément Rossetti </p>
            <p id="fonction"> Responsable consultant</p>
        </a>
    </div>
    <br>
    <br>
</section>

<section class="section grise" id="mot-du-directeur">
    <br>
    <br>
    <h1 class="title lg text-center"> Le mot du Directeur </h1>
    <hr class="line-under-title">
    <div class="directeur">
        <br>
        <br>
        <h5> L’Association d’Informatique de Télécom Physique Strasbourg a tout mon soutien et je salue ses projets particulièrement ambitieux.<br><br>
            Ce projet associatif renforcera j’en suis certain l’entraide entre élèves-ingénieurs et par là même leur sentiment d’appartenance à une grande école d'ingénieurs.<br><br>
            Les 5 Pôles mis en place permettent aux élèves de mettre en pratique et compléter leur formation académique, que ce soit à travers le développement de programmes utiles, de jeux vidéo, d’applications mobiles ou de site Web.<br><br>
            J’encourage particulièrement la participation à des compétitions informatiques bénéfiques à la visibilité de Télécom Physique Strasbourg et de son Département Informatique et Réseaux.<br><br>Vous pourrez compter sur le soutien de votre directeur ! </h5>
        <img class="profil-rounded" src="images/logo/collet.jpg">
        <p id="nom"> Christophe Collet </p>
        <p id="fonction">Directeur de l’école d’ingénieurs Télécom Physique Strasbourg</p>
        <a id="contact-anchor"></a>
        <br>
        <br>
    </div>
</section>


<section class="resume-section p-4 p-lg-5 text-center" id="contact">
    <h1 class="title lg text-center"> Contact </h1>
    <hr class="line-under-title">
    <br>
    <br>
    <div class="container" style="max-width: 100%;">
        <div class="row" style="justify-content: space-around;">
            <div id="gmap" class="col-sm-3 contact-widget-section2 wow animated fadeInLeft col-md-6" data-wow-delay=".2s" style="max-width: 600px">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2642.3720999403968!2d7.7347999514380845!3d48.52610033189745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796ca33e265b8bf%3A0x3a9eb5576462d5e3!2sT%C3%A9l%C3%A9com%20Physique%20Strasbourg!5e0!3m2!1sfr!2sfr!4v1591805091984!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div id="contact_cont" class="contact-form col-md-6">
                <form class="contact-form d-flex flex-column align-items-center" action="https://formspree.io/youremail@mail.com" method="POST">
                    <div class="form-group" style="width: 100%;">
                        <input type="name" class="form-control" placeholder="Nom" name="name" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input type="email" class="form-control" placeholder="Email" name="name" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Sujet" name="subject" required />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <textarea class="form-control" type="text" placeholder="Message" rows="9" name="name" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-rounded btn-primary" style="width: 200px;">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>




@endsection