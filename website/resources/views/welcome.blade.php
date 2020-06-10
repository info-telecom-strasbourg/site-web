@extends('layouts.layout')

@section('title', "ITS")

@section('breadcrumb')

@endsection

@section('content')


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner" height="100%">
        <div class="carousel-item active actu">
            <div class="carousel-caption">
                <h1>Info Telecom Strasbourg</h1>
                <br>
                <p>Notre toute nouvelle association débarque à TPS</p>
                <br>
                <input class="favorite styled" type="button" value="Découvrir nos projets">
            </div>
        </div>
        <div class="carousel-item actu">
            <div class="carousel-caption">
                <h1>Info Telecom Strasbourg</h1>
                <br>
                <p>Notre toute nouvelle association débarque à TPS</p>
                <br>
                <input class="favorite styled" type="button" value="Découvrir nos projets">
            </div>
        </div>
        <div class="carousel-item actu">
            <div class="carousel-caption">
                <h1>Info Telecom Strasbourg</h1>
                <br>
                <p>Notre toute nouvelle association débarque à TPS</p>
                <br>
                <input class="favorite styled" type="button" value="Découvrir nos projets">
            </div>
        </div>
        <div class="carousel-item actu">
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
</div>

<div class="section" id="poles-activites">
    <br>
    <br>
    <h1 class="title lg text-center"> Nos pôles d'activités </h1>
    <hr class="line-under-title">
    <br>
    <br>
    <div class="activites">
        <div class="card">
            <img src="images/illustrations/cours.jpg" style=" width: 500px; height: 300px;position:relative; z-index:3;">
            <!-- <div class="col-md-4">
                <a href="#" class="btn btn-primary">Cours & Accompagnements</a>
            </div> -->
        </div>
        <div class="card">
            <img src="images/illustrations/web.jpg" style=" width: 500px;height: 300px;">
            <!-- <div class="col-md-4">
                <a href="#" class="btn btn-primary">Applications & Sites Web</a>
            </div> -->
        </div>
        <div class="card">
            <img src="images/illustrations/prog.jpg" style=" width: 500px;height: 300px;">
            <!-- <div class="col-md-4">
                <a href="#" class="btn btn-primary">Programmation utilitaire</a>
            </div> -->
        </div>
    </div>
    <div class="activites">
        <div class="card">
            <img src="images/illustrations/compet.jpg" style=" width: 500px;height: 300px;">
            <!-- <div class="col-md-4">
                <a href="#" class="btn btn-primary">Compétitions</a>
            </div> -->
        </div>
        <div class="card">
            <img src="images/illustrations/jeux.jpg" style=" width: 500px;height: 300px;">
            <!-- <div class="col-md-4">
                <a href="#" class="btn btn-primary">Jeux Vidéos</a>
            </div> -->
        </div>
        <br>
        <br>
    </div>

    <div class="section grise" id="nos-projets">
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
                                <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
                                    <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                        <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                            accès à tous nos projets!
                                        </p>
                                        <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
                                    <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                        <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                            accès à tous nos projets!
                                        </p>
                                        <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
                                    <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                        <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                            accès à tous nos projets!
                                        </p>
                                        <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
                                    <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                        <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                            accès à tous nos projets!
                                        </p>
                                        <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
                                    <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                        <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                            accès à tous nos projets!
                                        </p>
                                        <a href="#" class="btn btn-rounded btn-primary" type="button">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card text-center shadow mb-5 bg-white rounded" style="width: 18rem;">
                                    <img class="card-img-top" src="/images/projets/projet.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold">Site web ITS</h5>
                                        <p class="card-text">Nous développons le site de notre association afin de vous permettre d'avoir un
                                            accès à tous nos projets!
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
    </div>


    <div class="section" id="agenda">
        <br>
        <br>
        <h1 class="title lg text-center"> Agenda </h1>
        <hr class="line-under-title">
        <br>
        <br>
        <div class="google-agenda">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23039BE5&amp;ctz=America%2FPort_of_Spain&amp;src=aW5mby50ZWxlY29tLnN0cmFzYm91cmdAZ21haWwuY29t&amp;color=%23E67C73&amp;showTabs=1&amp;showCalendars=0&amp;showPrint=0&amp;showTitle=0&amp;showTz=0&amp;showDate=1&amp;showNav=0" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
        </div>
        <br>
        <br>
    </div>
    <div class="section grise" id="quelques-chiffres">
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
    </div>

    <div class="section" id="equipe">
        <br>
        <br>
        <h1 class="title lg text-center"> Notre équipe </h1>
        <hr class="line-under-title">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>

    <div class="section grise" id="mot-du-directeur">
        <br>
        <br>
        <h1 class="title lg text-center"> Le mot du Directeur </h1>
        <hr class="line-under-title">
        <br>
        <br>
        <p> "Pour un hypocrite être démasqué est un échec, mais se démasquer est une victoire." </p>
        <br>
        <br>
    </div>

    <div class="section" id="contact">
        <br>
        <br>
        <h1 class="title lg text-center"> Contact </h1>
        <hr class="line-under-title">
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2642.3720999403968!2d7.7347999514380845!3d48.52610033189745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796ca33e265b8bf%3A0x3a9eb5576462d5e3!2sT%C3%A9l%C3%A9com%20Physique%20Strasbourg!5e0!3m2!1sfr!2sfr!4v1591805091984!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>


                </div>

                <!-- Formulaire de contact -->
                <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                    <form class="shake" role="form" method="post" id="contactForm" name="contact-form" data-toggle="validator">
                        <!-- Nom -->
                        <div class="form-group label-floating">
                            <label class="control-label" for="name">Nom</label>
                            <input class="form-control" id="name" type="text" name="name" required data-error="Entre votre nom">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Email -->
                        <div class="form-group label-floating">
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" required data-error="Entre votre email">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Sujet -->
                        <div class="form-group label-floating">
                            <label class="control-label">Sujet</label>
                            <input class="form-control" id="msg_subject" type="text" name="subject" required data-error="Entrer le sujet de votre message">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Message -->
                        <div class="form-group label-floating">
                            <label for="message" class="control-label">Message</label>
                            <textarea class="form-control" rows="3" id="message" name="message" required data-error="Entrer votre message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-- Envoyer -->
                        <div class="form-submit mt-5">
                            <button class="btn btn-common" type="submit" id="form-submit"><i class="material-icons mdi mdi-message-outline"></i> Envoyer</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>





    @endsection