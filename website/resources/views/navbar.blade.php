<nav class="navbar navbar-expand-xl navbar-light fixed-top">
    <a class="navbar-brand" href="#">
        <img src="images/logo/logo.png" width="90" height="90" alt="Logo du site">
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
        <ul class="navbar-nav mx-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : ''  }}">
                <a class="nav-link" href="/">ACCUEIL <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
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
            <li class="nav-item {{ Request::is('projets') ? 'active' : ''  }}">
                <a class="nav-link" href="/projets">PROJETS</a>
            </li>
            <li class="nav-item {{ Request::is('users') ? 'active' : ''  }}">
                <a class="nav-link" href="/users">MEMBRES</a>
            </li>
            {{-- TODO lien a ajouter --}}
            <li class="nav-item {{ Request::is('A_COMPLETER') ? 'active' : ''  }}">
                <a class="nav-link" href="#A_COMPLETER">BESOIN D'AIDE</a>
            </li>
            </li>
            {{-- TODO lien a ajouter --}}
            <li class="nav-item {{ Request::is('A_COMPLETER') ? 'active' : ''  }}">
                <a class="nav-link" href="contact">CONTACT</a>
            </li>
        </ul>  
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="/login" class="btn btn-rounded btn-primary connexion" type="button">CONNEXION</a>
            </li>
        </ul>
    </div>
</nav>