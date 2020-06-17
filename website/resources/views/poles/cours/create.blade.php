@extends('layouts.layout')

@section('title')
Création d'un cours
@endsection

@section('content')

<div class="container">
	<form id="creat-cours" class="" action="{{ route('poles.cours.store') }}" method="post" enctype="multipart/form-data">
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


		<div class="dates-select">
			<div class="dates-pres">
				Dates en présentiel:
				<div id="calendar-pres">
		        	<div id="cal-pres-dates">

		        	</div>
    			</div>
			</div>

			<div class="dates-dist">
				Dates en distenciel:
				<div id="calendar-dist">
		        	<div id="cal-dist-dates">

		        	</div>
    			</div>
			</div>
		</div>



		<button id="submit-btn" type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
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
