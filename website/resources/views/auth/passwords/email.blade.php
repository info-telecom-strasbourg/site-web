<!-- Send the password reset link -->

@extends('layouts.layout')

@section('content')

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

<div class="card" style="width: 700px; background-color: rgba(0, 0, 0, 0.7); color: white;">
    <div class="card-header" style="background-color: rgba(0, 0, 0, 0.9);">{{ __('Réinitialiser votre mot de passe') }}</div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Give the email -->
            <div class="form-group text-center" style="margin-bottom: 30px;">
                <label for="email" class="col-md-4 mb-2 col-form-label">{{ __('Entrer votre email') }}</label>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!--Button to send the password reset link -->
            <div class="form-group row mb-0 justify-content-center">
                <div class="col-md-6 text-center">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        {{ __('Envoyer le lien de réinitialisation') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection