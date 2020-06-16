@extends('layouts.layout')

@section('title')
Création d'un cours
@endsection

@section('content')

<div class="container">
	<form class="" action="{{ route('poles.cours.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- Pour le titre -->
		<h4 class="title md text-left">Titre</h4>
		<div class="form-group">
			<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $cours->title }}" required autocomplete="title" autofocus>

			@error('title')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror

		</div>

		<!-- Pour la description -->
		<h4 class="title md text-left">Description</h4>
		<div class="form-group">
			<div class="control">
				<textarea class="desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required>{{ $cours->desc }}</textarea>
			</div>

			@error('desc')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror

		</div>

		<!-- Pour ajouter un/des fichiers -->
		<h4 class="title md text-left">Ajouter des fichiers</h4>
		<div class="form-group">
			<input type="file" id="link_support" name="link_support[]" multiple>
		</div>

		<!-- Pour supprimer des fichiers -->
		<h4 class="title md text-left">Supprimer des fichiers</h4>
		<div class="form-group" id="delete-files">
			@forelse ( $cours->supports as $support )
				<div>
					<input type="checkbox" id="{{ $support->name }}" name="{{ $support->name }}" value="{{ $support->name }}">
    				<label for="{{ $support->name }}">{{ $ref->name }}</label>
				</div>
			@empty
			<div>
				Il n'y a aucun support pour ce cours.
			</div>
			@endforelse
		</div>
		<div class="text-center">
			<button type="submit" class="btn btn-primary btn-rounded">Edit</button>
		</div>
	</form>
</div>
@endsection
