@extends('layouts.layout')

@section('title', 'Création de pôle')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item">Création du pole</li>
@endsection

@section('content')
	<!-- Le formulaire de création -->
	<form action="/pole/create" method="post" enctype="multipart/form-data">
	@csrf

		<!-- Title of the pole -->
		<div class="form-group">
			<label class="form-title-small" for="title">Titre</label>
			<div class="control">
				<input class="form-control @error('title') is-invalid @enderror" type="text" value="{{ old('title') }}" id="title" name="title" required>
			</div>
		</div>
		@error('title')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<!-- Description of the pole -->
		<div class="form-group">
			<label class="form-title-small" for="desc">Decription</label>
			<div class="control">
				<textarea class="form-control desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="10" required>{{ old('desc') }}</textarea>
			</div>
		</div>
		@error('desc')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<!-- Button to edit the pole -->
		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
			<button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
		</div>
	</form>
@endsection
