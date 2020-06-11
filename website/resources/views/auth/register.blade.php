@extends('layouts.layout')

@section('title', 'Liste des membres')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/">Membres</a></li>
<li class="breadcrumb-item active">Créer un membre</li>
@endsection

@section('content')

<div class="container">
    <h1 class="title lg text-center">
        Créer un membre
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <form method="POSt" action="{{ route('register')}}" >
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Mot de passe</label>
                <select class="custom-select" id="role" name="role" required>
                    <option selected readonly>Choisir un role ...</option>
                    @if(isset($roles))

                    @foreach ($roles as $key => $role)
                    <option value="{{ $key + 1 }}">{{ $role->role }}</option>
                    @endforeach
                    @endif
                </select>

                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>Choisissez un rôle</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirmé le mot de passe</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
        </form>
    </div>
</div>

@endsection