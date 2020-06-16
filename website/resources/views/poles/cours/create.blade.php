@extends('layouts.layout')

@section('title')
Création d'un cours
@endsection

@section('content')

<div class="container">
	<form class="" action="{{ route('poles.cours.store') }}" method="post" enctype="multipart/form-data">
		@csrf

		<div class="form-group">
			<label for="title">Titre</label>

			<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

			@error('title')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div class="form-group">
			<label for="desc">Description</label>

			<div class="control">
				<textarea class="desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required>{{ old('desc') }}</textarea>
			</div>

			@error('desc')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>


		<div class="form-group">
			<label for="link_support">Choisissez un fichier</label>
			<br>
			<input type="file" id="link_support" name="link_support[]" multiple>
		</div>

		<div class="form-group" id="choose-visibility">
		</div>

		<button type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
	</form>
</div>
@endsection
