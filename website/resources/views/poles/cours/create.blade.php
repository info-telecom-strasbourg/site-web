@extends('layouts.layout')

@section('title')
Création d'un cours
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Création d'un cours
	</h1>
	<form id="creat-cours" class="" action="{{ route('poles.cours.store') }}" method="post" enctype="multipart/form-data">
		@csrf

		<div class="form-group">
			<h4 class="title lg text-left">
				Titre
			</h4>

			<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

			@error('title')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div class="form-group">
			<h4 class="title lg text-left">
				Description
			</h4>

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
			<h4 class="title lg text-left">
				Fichiers associés
			</h4>

			<input type="file" id="link_support" name="link_support[]" multiple>
		</div>

		<div class="form-group" id="choose-visibility">
		</div>

		<div class="dates-select">
			<h4 class="title lg text-left">
				Dates en présentiels
			</h4>
			<div class="dates-pres">
				<div id="calendar-pres">
		        	<div id="cal-pres-dates">

		        	</div>
    			</div>
			</div>

			<h4 class="title lg text-left">
				Dates en distanciels
			</h4>
			<div class="dates-dist">
				<div id="calendar-dist">
		        	<div id="cal-dist-dates">

		        	</div>
    			</div>
			</div>
		</div>


		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
			<button id="submit-btn" type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
		</div>
	</form>
</div>
<script>
	var elePres = document.getElementById('calendar-pres');
	if(elePres) {
		elePres.style.visibility = "visible";
	 }

	 var eleDist = document.getElementById('calendar-dist');
 	if(eleDist) {
 		eleDist.style.visibility = "visible";
 	 }
</script>
@endsection
