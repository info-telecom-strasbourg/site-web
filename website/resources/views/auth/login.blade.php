<!-- Login -->

@extends('layouts.layout')

@section('title', 'Connexion')

@section('content')

<!-- Button to get to the previous page -->
<a class="btn btn-primary btn-rounded" style="font-size: 20px; position: absolute; top: 10px; left: 10px; padding: 5px 15px; text-decoration: none; z-index: 10000; color: white;" data-toggle="tooltip" data-placement="right" title="Retour vers la page de connexion." onclick="window.history.back()">
    <i class="fas fa-angle-left" ></i>
</a>

<style>
    #content {
        padding-bottom: 0;
    }
</style>

<div class="login-container full-screen">
    <div class="container text-center">
        <div class="row justify-content-center min-vh-100">
            <div class="col">
                <div class="d-flex flex-column h-100">

                    <!-- Welcome message -->
                    <div class="row justify-content-center d-flex flex-column">
                        <h1 class="h1">Se connecter</h1>
                        <p>Heureux de vous revoir !</p>
                        <p>
                            <a href="/#contact" class="respo-support">Envoyez-nous un message</a> pour devenir membre <br> et pouvoir vous connecter.
                        </p>
                    </div>


                    <!-- Authentication -->
                    <div class="row justify-content-center flex-grow-1" id="form-container">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Check the mail -->
                            <div class="form-group email-group">
                                <label for="email">E-MAIL</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrer l'email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Check the password -->
                            <div class="form-group password-group">
                                <label for="passowrd">MOT DE PASSE</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Entrer votre mot de passe">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <!-- If the password is forgotten -->
                                <div class="col-sm-6">
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="password-forget">
                                        Mot de passe oublié ?
                                    </a>
                                    @endif
                                </div>

                                <!-- Remember the account -->
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="favorite styled">SE CONNECTER</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
