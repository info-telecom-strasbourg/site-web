@extends('layouts.layout')

@section('title')
Création d'une compétition
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Création d'une compétition
	</h1>
	<form id="creat-comp" action="{{ route('poles.competitions.store') }}" method="post" enctype="multipart/form-data">
		@csrf

		<div class="form-group">
			<h4 class="title lg text-left">
				Nom
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


		<div class="dates-select">
			<h4 class="title lg text-left">
				Dates de compétitions
			</h4>
			<div class="dates-comp">
				<div id="calendar-comp">
		        	<div id="cal-comp-dates">

		        	</div>
    			</div>
			</div>
		</div>

		<div class="form-group">
			<h4 class="title lg text-left">
				Images (3 maximum)
			</h4>

			<input type="file" id="images" name="images[]" multiple>
		</div>

		<h4 class="title lg text-left">
			Lien vers le site web
		</h4>

		<input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website">
		@error('website')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
			<button id="submit-btn-crt-cpt" type="submit" class="btn btn-primary btn-rounded compet">AJOUTER</button>
		</div>
	</form>
</div>
<script>
	var datesComp = document.getElementById('calendar-comp');
	if(datesComp) {
		datesComp.style.visibility = "visible";
	 }
</script>
@endsection

<!--
Problèmes avec dates encore
 -->