@extends('layouts.layout')

@section('title', 'Connexion')

@section('content')

<style>
    #content {
        padding-bottom: 0;    /* Footer height */
    }
</style>

<div class="login-container full-screen">
    <div class="container text-center">
        <div class="row justify-content-center min-vh-100">
            <div class="col">
                <div class="d-flex flex-column h-100">
                    <div class="row justify-content-center d-flex flex-column">
                        <h1 class="h1">Se connecter</h1>
                        <p>Heureux de vous revoir !</p>
                        <p>
                            <a href="/#contact" class="respo-support">Envoyez nous un message</a> pour devenir membre et pouvoir vous connecter.
                        </p>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="form-container">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group email-group">
                                <label for="email">E-MAIL</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrer l'email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Le mail n'est pas correcte</strong>
                                        </span>
                                    @enderror
                            </div>              

                            <div class="form-group password-group">
                                <label for="passowrd">MOT DE PASSE</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Entrer votre mot de passe">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Le mot de passe n'est pas correcte</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="password-forget">
                                            Mot de passe oublié ?
                                        </a>
                                    @endif
                                </div>
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

<script>
// permet de faire en sorte que le carousel fasse exactement la taille de l'écran
// de l'utilisateur

// $(window).on('resize', function() {
//     $wHeight = $(document).height();
//     $item.height($wHeight);
// });
</script>
@endsection

{{-- @extends('layouts.app') --}}

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
