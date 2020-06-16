<nav class="navbar navbar-expand-xl navbar-light fixed-top">
    <a class="navbar-brand" href="/page-admin">
        <img src="/images/logo/logo.png" width="90" height="90" alt="Logo du site">
    </a>

    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="nav navbar-nav not-shown">
        <li class="nav-item hidden">
            <a href="#" class="btn btn-rounded btn-primary connexion" type="button">CONNEXION</a>
        </li>
    </ul>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto navbar-nav">
            <a href="/">
                <li class="nav-item onglet {{ Request::is('/') ? 'active' : ''  }}">
                    <div class="nav-link">ACCUEIL <span class="sr-only">(current)</span></div>
                </li>
            </a>
            <li class="nav-item onglet dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PÔLES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Cours & Accompagnements</a>
                    <a class="dropdown-item" href="#">Applications & Sites Web</a>
                    <a class="dropdown-item" href="#">Programmation utilitaire</a>
                    <a class="dropdown-item" href="#">Compétitions</a>
                    <a class="dropdown-item" href="#">Jeux Vidéos</a>
                </div>
            </li>
            <a href="/projets">
                <li class="nav-item onglet {{ Request::is('projets') ? 'active' : ''  }}">
                    <div class="nav-link">PROJETS</div>
                </li>
            </a>
            <a href="/users">
                <li class="nav-item onglet {{ Request::is('users') ? 'active' : ''  }}">
                    <div class="nav-link">MEMBRES</div>
                </li>
            </a>
            <a href="/besoin-aide">
                <li class="nav-item onglet {{ Request::is('besoin-aide') ? 'active' : ''  }}">
                    <div class="nav-link">BESOIN D'AIDE</div>
                </li>
            </a>
            <a class="js-scrollTo" href="/#contact-anchor">
                <li class="nav-item onglet">
                    <div class="nav-link" >CONTACT</div>
                </li>
            </a>
        </ul>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="/login" class="btn btn-rounded btn-primary connexion" type="button">CONNEXION</a>
            </li>
        </ul>
    </div>
</nav>