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

	<label for="title"> Titre</label>
	<input id="title" type="text" name="title" value="{{ old('title') }}">

	<div class="text-center" style="margin-top:25px; margin-bottom:25px">
		<button type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
	</div>
	</form>
@endsection
