@extends('layouts.layout')

@section('title')
Création d'un cours
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active"><a href="/poles/cours">Pôle Cours</a></li>
<li class="breadcrumb-item active">Création</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Création d'un cours
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<form id="creat-cours" action="{{ route('poles.cours.store') }}" method="post" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label for="title" class="form-title-small">Titre</label>

				<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>

			<div class="form-group">
				<label for="desc" class="form-title-small">Description</label>

				<div class="control">
					<textarea class="form-control @error('desc') is-invalid @enderror desc" id="desc" name="desc" rows="5" required>{{ old('desc') }}</textarea>
				</div>

				@error('desc')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>

			<div class="form-group">
				<label for="creators" class="form-title-small">Ajouter des créateurs</label>
				<select class="custom-select" name="creators[]" id="creators" size="4" required multiple>
		            <option readonly selected hidden value="">Créateurs</option>

		            @isset($users)
		                @foreach ($users as $user)
		                    <option value="{{ $user->id }}" {{ auth()->user()->is($user) ? 'selected' : '' }}>{{ $user->name }}</option>
		                @endforeach
		            @endisset
		        </select>
			</div>

			<div class="form-group">
				<label for="image_crs" class="form-title-small">				
					Image pour la vignette du cours (optionnelle)
				</label>
				<br>
				<input type="file" id="image_crs" name="image_crs">
			</div>


			<div class="form-group">
				<label for="link_support_mod" class="form-title-small">		
					Fichiers associés
				</label>
				<br>
				<input type="file" id="link_support" name="link_support[]" multiple>
			</div>

			<h4 class="form-title" id="choose-visibility">
				Cochez les fichiers réservés aux membres
			</h4>
			<div class="form-group" id="choose-visibility">
			</div>

			<h4 class="form-title">Dates du cours</h4>
			<div class="row justify-content-around dates-select">
				<div class="col-md-auto">
					<label class="form-title-small">				
						Dates en présentiels
					</label>
					<div class="dates-pres text-center">
						<div id="calendar-pres">
							<div id="cal-pres-dates">

							</div>
						</div>
					</div>
				</div>

				<div class="col-md-auto">
					<label class="form-title-small">				
						Dates en distanciels
					</label>
					<div class="dates-dist">
						<div id="calendar-dist">
							<div id="cal-dist-dates">

							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="dates-crs">

			</div>


			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<button id="submit-btn-crt-crs" type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
			</div>
		</form>
	</div>
</div>
<script>
	var elePres = document.getElementById('calendar-pres');
	if(elePres)
	{
		elePres.style.visibility = "visible";
	}

	var eleDist = document.getElementById('calendar-dist');
 	if(eleDist)
	{
 		eleDist.style.visibility = "visible";
 	}
</script>
@endsection
