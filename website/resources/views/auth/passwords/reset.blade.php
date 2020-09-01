<!-- Reset the password -->

@extends('layouts.layout')

@section('title', 'Reset')

@section('content')
    <!-- Button to get to the login page -->
    <a class="btn btn-primary btn-rounded" href="/login"
        style="font-size: 20px; position: absolute; top: 10px; left: 10px; padding: 5px 15px; text-decoration: none; color: white;"
        data-toggle="tooltip" data-placement="right" title="Retour vers la page précédente.">
        <i class="fas fa-angle-left"></i>
    </a>

    <style>
        #content {
            padding-bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background: url('../images/fond/login-fond.png') top center;
            background-size: cover;
            position: relative;
        }

        .main-content {
            width: 100%;
            display: flex;
            justify-content: center;
            padding-left: 30px;
            padding-right: 30px;
        }

    </style>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Give the email -->
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Votre adresse email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Give the new password -->
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm the new password -->
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirmer votre mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Reset the password -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Réinitialiser votre mot de passe') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
