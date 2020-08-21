<!-- Navbar -->

<nav class="navbar navbar-expand-xl navbar-light fixed-top">
    <!-- Manage the access of the dark page with the logo -->
    @if (Auth::check() && Auth::user()->role_id == 4)
        <a class="navbar-brand" href="/page-admin">
            <img src="/images/logo/logo.png" width="90" height="100%" alt="Logo du site">
        </a>
    @else
        <a class="navbar-brand">
            <img src="/images/logo/logo.png" width="90" height="100%" alt="Logo du site">
        </a>
    @endif

    <!-- Toggle -->
    <button class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Login button -->
    <ul class="nav navbar-nav not-shown">
        <li class="nav-item hidden">
            <a href="#" class="btn btn-rounded btn-primary connexion" type="button">CONNEXION</a>
        </li>
    </ul>

    <!-- The navbar sections -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto navbar-nav">
            <!-- Welcome page -->
            <a href="/">
                <li class="nav-item onglet {{ Request::is('/') ? 'active' : ''  }}">
                    <div class="nav-link">ACCUEIL <span class="sr-only">(current)</span></div>
                </li>
            </a>

            <!-- "Pôles" sections -->
            <li class="nav-item onglet dropdown {{ Request::is('poles/*') ? 'active' : ''  }}" id="poles">
                <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    PÔLES
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/poles/cours">Cours & Accompagnements</a>
                    <a class="dropdown-item" href="/poles/applications_et_sites_web">Applications & Sites Web</a>
                    <a class="dropdown-item" href="/poles/programmation_utilitaire">Programmation utilitaire</a>
                    <a class="dropdown-item" href="/poles/competitions">Compétitions</a>
                    <a class="dropdown-item" href="/poles/jeux_vidéos">Jeux Vidéos</a>
                </div>
            </li>

            <!-- Projects page -->
            <a href="/projets">
                <li class="nav-item onglet {{ Request::is('projets*') ? 'active' : ''  }}">
                    <div class="nav-link">PROJETS</div>
                </li>
            </a>

            <!-- Users page -->
            <a href="/users">
                <li class="nav-item onglet {{ Request::is('users') ? 'active' : ''  }}">
                    <div class="nav-link">MEMBRES</div>
                </li>
            </a>

            <!-- Outils de l'association -->
            <li class="nav-item onglet dropdown {{ (Request::is('besoin-aide') || Request::is('topic')) ? 'active' : ''  }}" id="poles">
                <a id="outilsAssoDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    OUTILS
                </a>

                <div class="dropdown-menu" aria-labelledby="outilsAssoDropdown">
                    <a class="dropdown-item" href="/besoin-aide">Besoin d'aide</a>
                    <a class="dropdown-item" href="/topics">Boîte à idées</a>
                </div>
            </li>
            
            <!-- Contact -->
            <a class="js-scrollTo" href="/#contact-anchor">
                <li class="nav-item onglet">
                    <div class="nav-link" >CONTACT</div>
                </li>
            </a>
        </ul>

        <!-- Manage the display of the login or the username with the logout button -->
        <ul class="nav navbar-nav">
            @guest
                <li class="nav-item">
                    <a href="/login" class="btn btn-rounded btn-primary connexion">CONNEXION</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-right: 27px">
                        <a class="dropdown-item" href="/users/{{ Auth::user()->id }}">Profil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Déconnexion
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
