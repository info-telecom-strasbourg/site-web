<div class="container pt-3">
    <!-- Message after successful edit -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row justify-content-around">
        <!-- Edit profil information -->
        <div class="col-md-4">
            <div class="row justify-content-center align-items-center flex-column profil-card profil-edit">

                <!-- Profil image badge -->
                <img class="profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}" />
                <!-- Change profil picture -->
                <form action="/users/{{ $user->id }}/avatar" id="avatar" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="inputfile @error('profil_picture') is-invalid @enderror"
                        name="profil_picture" id="profil_picture" accept="image/x-png,image/gif,image/jpeg">
                    <label for="profil_picture">Modifier</label>

                    @error('profil_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </form>

                <form action="/users/{{ $user->id }}" method="POST" id="form-profil-edit">
                    @csrf
                    @method('PUT')

                    <!-- User's name -->
                    <div class="input-group">
                        <input type="text" class="custom-form-control form-control" id="name" name="name"
                            placeholder="Nom" value="{{ $user->name }}">
                    </div>

                    <!-- User's Email address -->
                    <div class="input-group">
                        <input type="email" class="custom-form-control form-control" id="email" name="email"
                            placeholder="Adresse e-mail" value="{{ $user->email }}">
                    </div>

                    <!-- User's class -->
                    <div class="input-group">
                        <input type="text" class="custom-form-control form-control" id="class" name="class"
                            placeholder="Filière" value="{{ $user->class }}">
                    </div>

                    <!-- User's year -->
                    <div class="input-group">
                        <input type="text" class="custom-form-control form-control" id="year" name="year"
                            placeholder="Promotion" value="{{ $user->year }}">
                    </div>


                    <!-- Password -->
                    <div class="input-group">
                        <input type="password"
                            class="custom-form-control form-control pwd @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Nouveau mot de passe" data-toggle="tooltip"
                            data-placement="top" title="Ne rien mettre pour garder l'ancien mot de passe.">
                        <span class="input-group-btn">
                            <button class="btn btn-default reveal" type="button"><i
                                    class="eye-icon far fa-eye"></i></button>
                        </span>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Confirm password -->
                    <div class="input-group">
                        <input type="password" class="custom-form-control form-control pwd-confirm"
                            id="password_confirmation" name="password_confirmation" placeholder="Nouveau mot de passe">
                        <span class="input-group-btn">
                            <button class="btn reveal-confirm" type="button"><i
                                    class="eye-icon-confirm far fa-eye"></i></button>
                        </span>
                    </div>

                    <!-- Button to edit the profil information -->
                    <div class="text-center" style="margin-top:25px;">
                        <button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <!-- List all projects of the current user-->
            <div class="row flex-column profil-card">
                <div class="profil-card-header row justify-content-between align-items-center">
                    <h6 class="text-center" style="margin-bottom: 0;">Mes projets</h6>

                    <!-- Search bar -->
                    <form class="form-inline d-flex justify-content-center md-form form-sm" style="flex-flow: nowrap;">
                        <input class="custom-form-control profil-search disabled" type="text" id="search-projet"
                            name="search" placeholder="Search..." aria-label="Search">
                        <i class="search-button fas fa-search" aria-hidden="true"></i>
                    </form>
                </div>

                <!-- List of projects -->
                <div class="profil-card-body">
                    @foreach ($user->projets as $project)
                    <a href="/projets/{{ $project->id }}"
                        class="profil-card-item row justify-content-between align-items-center">
                        <span>{{ $project->title}}</span>
                        <button type="submit" class="btn btn-primary btn-rounded"
                            onclick="self.location.href='/projets/{{ $project->id }}'">Aller</button>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- List all lessons the current user created -->
            <div class="row flex-column profil-card">
                <div class="profil-card-header row justify-content-between align-items-center">
                    <h6 class="text-center" style="margin-bottom: 0;">Mes cours</h6>

                    <form class="form-inline d-flex justify-content-center md-form form-sm" style="flex-flow: nowrap;">
                        <!-- Search bar -->
                        <input class="custom-form-control profil-search profil-search-cours disabled" type="text"
                            id="search-cours" name="search" placeholder="Search..." aria-label="Search">
                        <i class="search-button-cours fas fa-search" aria-hidden="true"></i>

                        <!-- Add new lesson button -->
                        @can ('create', 'App\Cours')
                        <a class="btn btn-primary btn-rounded add-cours" href="/poles/cours/create"><i
                                class="fas fa-plus"></i></a>
                        @endcan
                    </form>
                </div>

                <!-- List of lessons -->
                <div class="profil-card-body">
                    @foreach ($user->cours as $lesson)
                    <a href="/poles/cours/{{ $lesson->id }}"
                        class="profil-card-item row justify-content-between align-items-center">
                        <span>{{ $lesson->title}}</span>
                        <button type="submit" class="btn btn-primary btn-rounded"
                            onclick="self.location.href='/poles/cours/{{ $lesson->id }}'">Aller</button>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <!-- List all competitions the current user attends -->
            <div class="row flex-column profil-card profil-show-cours">
                <div class="profil-card-header row justify-content-between align-items-center">
                    <h6 class="text-center" style="margin-bottom: 0;">Mes compétitions</h6>

                    <!-- Search bar -->
                    <form class="form-inline d-flex justify-content-center md-form form-sm" style="flex-flow: nowrap;">
                        <input class="custom-form-control profil-search disabled" type="text" id="search-compet"
                            name="search" placeholder="Search..." aria-label="Search">
                        <i class="search-button fas fa-search" aria-hidden="true"></i>
                    </form>
                </div>

                <!-- List of competitions -->
                <div class="profil-card-body">
                    @foreach ($user->competitions as $competition)
                    <a href="/poles/competitions/{{ $competition->id }}"
                        class="profil-card-item row justify-content-between align-items-center">
                        <span>{{ $competition->title}}</span>
                        <button type="submit" class="btn btn-primary btn-rounded"
                            onclick="self.location.href='/poles/competitions/{{ $competition->id }}'">Aller</button>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(".alert").delay(4000).slideUp(200, function() {
    $(this).alert('close');
});

document.getElementById("profil_picture").onchange = function() {
    document.getElementById("avatar").submit();
};
</script>