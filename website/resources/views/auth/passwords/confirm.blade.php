@extends('layouts.layout')

@section('content')

<style>
    #content {
        padding-bottom: 0;    /* Footer height */
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

            <div class="card" style="width: 700px; background-color: rgba(0, 0, 0, 0.7); color: white;" id="confirm">
                <div class="card-header" style="background-color: rgba(0, 0, 0, 0.9);">{{ __('Confirmer votre mot de passe') }}</div>
                <div class="card-body">
                    {{ __('Confirmer votre mot de passe pour continuer') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group text-center" style="margin-bottom: 30px; margin-top: 30px;">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Mot de passe') }}</label>

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center align-items-center">
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-primary btn-rounded">
                                    {{ __('Confirmer') }}
                                </button>
                            </div>
                            <div class="col-xs-6">
                                @if (Route::has('password.request'))
                                <a class="password-forget" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
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
@endsection