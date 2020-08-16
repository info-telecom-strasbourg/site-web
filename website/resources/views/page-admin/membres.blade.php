<!-- The darkpage -->
<!-- WILL BE COMMENTED LATER -->
@extends('layouts.layout')

@section('title', 'Admin')

@section('breadcrumb')

@endsection

@section('content')

<style>
    #content {
        padding-bottom: 0;
    }
</style>


<section class="dark-page" id="vue-ens">
    <div class="bandeau-dark">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle total" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Profil</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle short" type="button" data-toggle="dropdown">
                <img class="profil-rounded" src="images/defaut/profil.jpg">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/users/{{ Auth::user()->id }}">Profil</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="nav flex-column nav-pills short" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
        <div class="navbar-dark-brand" href="/">
            <a href="/">
                <img src="/images/logo/logo-dark.png" width="90" height="100%" alt="Logo du site">
            </a>
        </div>
        <a class="nav-link" href="/page-admin/vue-ensemble">VUE D'ENSEMBLE</a>
        <a class="nav-link active" href="#">MEMBRES</a>
        <a class="nav-link" href="/page-admin/actualites">ACTUALITÉS</a>
    </div>
    <div class="container">
        <div class="nav flex-column nav-pills total" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="navbar-dark-brand" href="/">
                <a href="/">
                    <img src="/images/logo/logo-dark.png" width="90" height="90" alt="Logo du site">
                </a>
            </div>
            <a class="nav-link" href="/page-admin/vue-ensemble">VUE D'ENSEMBLE</a>
            <a class="nav-link active" href="#">MEMBRES</a>
            <a class="nav-link" href="/page-admin/actualites">ACTUALITÉS</a>
        </div>
        <div class="tab-content" id="v-pills-tabContent" style="padding-bottom: 300px">
            <div class="tab-pane fade show active" id="v-pills-membres" role="tabpanel" aria-labelledby="v-pills-membres-tab">
            <h1 class="title lg text-center"> Membres </h1>
                <hr class="line-under-title">
                <div id="members-container">
                    <!-- Error message if try to delete a member who is the chief of a project -->
                    @if(\Session::has('erreur'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! \Session::get('erreur') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <!-- Add a new member -->
                    <button id="button-new-member" type="button" data-toggle="modal" data-target="#new-member" class="btn btn-primary">Ajouter un membre</button>
                    <div class="modal" id="new-member">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Nouveau membre</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;">
                                        <span>&times;</span> <!-- Cross button -->
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('register')}}">
                                        @csrf

                                        <!-- Give the member name -->
                                        <div class="form-group">
                                            <label for="name" class="form-title-small">Nom</label>

                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            <span id="name-error" class="invalid-feedback" role="alert" style="display: none;">
                                                <strong>Vous devez entrer un nom de plus de 3 caractères</strong>
                                            </span>
                                        </div>

                                        <!-- Give the member email -->
                                        <div class="form-group">
                                            <label for="email" class="form-title-small">Adresse email</label>

                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">

	                                        <span id="email-error" class="invalid-feedback" role="alert" style="display: none;">
	                                            <strong>Vous devez entrer un email unique</strong>
	                                        </span>
                                        </div>

                                        <!-- Give the member role -->
                                        <div class="form-group">
                                            <label for="role" class="form-title-small">Rôle</label>
                                            <select class="custom-select" id="role" name="role" required>
                                                @if(isset($roles))

                                                @foreach ($roles as $role)
	                                                @if($role->isAvailable())
		                                                <option value="{{ $role->id }}" @if (old('role')==$role->id) selected @endif>{{ $role->role }}
		                                                </option>
	                                                @endif
                                                @endforeach

                                                @endif

                                            </select>
                                        </div>

                                        <!-- Give the member password -->
                                        <div class="form-group">
                                            <label for="password" class="form-title-small">Mot de passe</label>

                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                                            <span id="password-error" class="invalid-feedback" role="alert" style="display: none;">
                                                <strong>Le mot de passe ne coïncide pas ou est trop court (8 caractères min)</strong>
                                            </span>
                                        </div>

                                        <!-- Confirm the member password -->
                                        <div class="form-group">
                                            <label for="password-confirm" class="form-title-small">Confirmer le mot de passe</label>

                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>

                                        <button id="create-member-btn" type="submit" class="btn btn-primary btn-rounded" style="margin-top:25px; margin-bottom:25px; width:100%;">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Number of members -->
                    <div style="color:white; margin-left: 20px; margin-bottom: 20px; font-style: italic;">Membres : {{ $users->count() }}</div>

                    <!-- User list -->
                    @foreach ($users as $user)
                    <div class="row">
                        <div class="d-flex bd-highlight">
                            <div id="image" class="p-2 bd-highlight"><img class="profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}" alt="profil picture"></div>
                            <div id="username" class="p-2 bd-highlight">{{ $user->name }}</div>
                            <div id="buttons" class="ml-auto p-2 bd-highlight">
                                <button type="button" data-toggle="modal" data-target="#infos{{ $user->id }}" class="btn btn-rounded button-panel">Voir</button>
                                <div class="modal" id="infos{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Profil détaillé</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;">
                                                    <span>&times;</span> <!-- Cross button -->
                                                </button>
                                            </div>
                                            <div class="modal-body" style="display: flex; flex-direction:column;">
                                                <img class="user-info profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}" alt="profil picture">
                                                <div class="user-info">
                                                    <b>Nom : </b> {{ $user->name }}
                                                </div>
                                                <div class="user-info">
                                                    <b>Rôle : </b> {{ $user->role->role }}
                                                </div>
                                                <div class="user-info">
                                                    <b>Adresse mail : </b> {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" data-toggle="modal" data-target="#edit{{ $user->id }}" class="btn btn-rounded button-panel">Editer</button>
                                <div class="modal" id="edit{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Modifications</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;">
                                                    <span>&times;</span> <!-- Cross button -->
                                                </button>
                                            </div>
                                            <img class="profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}" alt="photo de profile" style="margin-left: auto; margin-right:auto; margin-top: 20px; margin-bottom: 10px;">
                                            <form id="form-edit" action="/page-admin/user/{{ $user->id }}/edit" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <!-- Image -->
                                                <div style="display:flex;">
                                                    <input id="file{{ $user->id }}" type="file" name="image_profile" accept="image/x-png,image/gif,image/jpeg" style="margin-left: auto; margin-right:auto;"/>
                                                </div>

                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label for="name{{ $user->id }}" class="form-title-small">Nom</label>

                                                    <input id="name{{ $user->id }}" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                                </div>

                                                <span id="name-error{{ $user->id }}" class="invalid-feedback" role="alert" style="display: none;">
                                                    <strong>Le nom choisi est trop court</strong>
                                                </span>

                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label for="email{{ $user->id }}" class="form-title-small">Adresse email</label>

                                                    <input id="email{{ $user->id }}" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">

                                                    <span id="email-error{{ $user->id }}" class="invalid-feedback" role="alert" style="display: none;">
                                                        <strong>L'email choisi n'est pas valide (il doit être unique)</strong>
                                                    </span>
                                                </div>

                                                <!-- Roles -->
                                                <div class="form-group">
                                                    <label for="role{{ $user->id }}" class="form-title-small">Rôle</label>
                                                    <select class="custom-select" id="role{{ $user->id }}" name="role" required>

                                                        @if(isset($roles))

                                                        @foreach ($roles as $role)
                                                        @if($role->isAvailable() || $role->id == $user->role_id)
                                                        <option value="{{ $role->id }}" @if ($user->role->id == $role->id) selected @endif>{{ $role->role }}
                                                        </option>
                                                        @endif
                                                        @endforeach

                                                        @endif

                                                    </select>
                                                </div>

                                                <!-- Password -->
                                                <div class="form-group">
                                                    <label for="password{{ $user->id }}" class="form-title-small">Mot de passe</label>

                                                    <input id="password{{ $user->id }}" type="password" class="form-control @error('password{{ $user->id }}') is-invalid @enderror" name="password">

                                                    <span id="password-error{{ $user->id }}" class="invalid-feedback" role="alert" style="display: none;">
                                                        <strong>Le mot de passe ne coïncide pas ou est trop court (8 caractères min)</strong>
                                                    </span>
                                                </div>

                                                <!-- Confirm the member password -->
                                                <div class="form-group">
                                                    <label for="password-confirm{{ $user->id }}" class="form-title-small">Confirmer le mot de passe</label>

                                                    <input id="password-confirm{{ $user->id }}" type="password" class="form-control" name="password_confirmation">
                                                </div>

                                                <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                                                    <button id="submit-btn-edt-mb" type="submit" class="{{ $user->id }} btn btn-primary btn-rounded" style="width: 100%;;">Enregistrer</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-rounded button-panel" href="/page-admin/{{ $user->id }}/delete-user">Supprimer</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var usersAll = {!! $users !!};
        var usersEmail = [];
        usersAll.forEach(function(user) {
            usersEmail.push(user.email);
        });

		/**
		 * Check if the email given is unique (compare with the emails in the
	 	 * table 'users').
		 *
		 * @param emailToCheck: the email that will be checked.
		 * @return a boolean that indicate if the email is unique.
		 */
        function emailIsUnique(emailToCheck) {
            var isUnique = true;
            try {
                usersEmail.forEach(function(email) {
                    if (email.localeCompare(emailToCheck) == 0) {
                        isUnique = false;
                        throw Break;
                    }
                });
            } catch (exception) {
                if (exception != Break)
                    throw exception;
            } finally {
                return isUnique;
            }
        }

		/**
		 * Display the error message in the span given and linked to the input
		 * given.
		 *
		 * @param input: the input that contains the error.
		 * @param errorSpan: the span that have to be displayed.
		 */
		function displayError(input, errorSpan)
		{
			if(!input.hasClass('is-invalid'))
				input.addClass('is-invalid');
			$(errorSpan).css('display', 'block');
		}

		/**
		 * Hide the error message in the span given and linked to the input
		 * given.
		 *
		 * @param input: the input that do not contains error.
		 * @param errorSpan: the span that have to be hid.
		 */
		function eraseError(input, errorSpan)
		{
			if(input.hasClass('is-invalid'))
				input.removeClass('is-invalid');
			$(errorSpan).css('display', 'none');
		}

        /**
         * Check if all the values are acceptable to edit a member profil.
         */
        $('button#submit-btn-edt-mb').click(function(e) {
            var userId = $(this).attr('class').split(' ')[0];
            var currentUserEmail;
            usersAll.forEach(function(user) {
                if (user.id == userId)
                    currentUserEmail = String(user.email);
            });

			var inputName = $('input#name' + userId);
			var inputMail = $('input#email' + userId);
			var inputPassword = $('input#password' + userId);

            var userName = inputName.val();
            var userEmail = inputMail.val();
            var userRole = $('#role' + userId + ' option:selected').text();
            var userPw = inputPassword.val();
            var userPwc = $('input#password-confirm' + userId).val();
            var error = false;


			if (userName.length < 3)
			{
				error = true;
				displayError(inputName, 'span#name-error' + userId);
			}
			else
				eraseError(inputName, 'span#name-error' + userId);

			if ((userPw.length < 8 || userPw != userPwc) && userPw != "")
			{
				error = true;
				displayError(inputPassword, 'span#password-error' + userId);
				inputPassword.val('');
				$('input#password-confirm' + userId).val('');
			}
			else
				eraseError(inputPassword, 'span#password-error' + userId);

			if (!emailIsUnique(userEmail) && userEmail.localeCompare(currentUserEmail) != 0)
			{
				error = true;
				displayError(inputMail, 'span#email-error' + userId);
			}
			else
				eraseError(inputMail, 'span#email-error' + userId);

            if (error) e.preventDefault();
        });

		/**
		 * Check if all the values are acceptable to create a member.
		 */
		$('button#create-member-btn').click(function(e) {
			var inputName = $('input#name');
			var inputMail = $('input#email');
			var inputPassword = $('input#password');
			var inputPasswordConfirm = $('input#password-confirm');
			var password = inputPassword.val();
			var error = false;

			if(inputName.val().length < 3)
			{
				error = true;
				displayError(inputName, 'span#name-error');
			}
			else
				eraseError(inputName, 'span#name-error');

			if(!emailIsUnique(inputMail.val()))
			{
				error = true;
				displayError(inputMail, 'span#email-error');
			}
			else
				eraseError(inputMail, 'span#email-error');

			if((password.length < 8 || (password != inputPasswordConfirm.val())) && password != "")
			{
				error = true;
				displayError(inputPassword, 'span#password-error');
				inputPassword.val('');
				$('input#password-confirm').val('');
			}
			else
				eraseError(inputPassword, 'span#password-error');

			if(error) e.preventDefault();
		});
    });
</script>
@endsection