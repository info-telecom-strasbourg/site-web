<!-- Edit a lesson -->
@extends('layouts.layout')

@section('title')
Édition d'un cours
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/cours">Pôle cours & accompagnement</a></li>
<li class="breadcrumb-item"><a href="/poles/cours/{{ $cours->id }}">{{ $cours->title }}</a></li>
<li class="breadcrumb-item active">Édition</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Édition du cours : {{ $cours->title }}
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<form class="" action="/poles/cours/{{ $cours->id }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<!-- Edit the title of the lesson -->
			<div class="form-group">
				<label for="title" class="form-title-small">Titre</label>

				<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $cours->title }}" required autocomplete="title" autofocus>

				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

			</div>

			<!-- Edit the description of the lesson -->
			<div class="form-group">
				<label for="desc" class="form-title-small">Description</label>

				<textarea class="form-control desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="5" required>{{ $cours->desc }}</textarea>

				@error('desc')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

			</div>

			<!-- Edit the creators of the lesson -->
			<div class="form-group">
				<label for="creators" class="form-title-small">Ajouter des créateurs</label>

				<select class="custom-select" name="creators[]" id="creators" multiple>
					<option readonly selected hidden value="">Créateurs</option>

					@isset($users)
					@foreach ($users as $user)
					<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endforeach
					@endisset
				</select>
			</div>

			<!-- Edit the image to illustrate lesson -->
			<div class="form-group">
				<label for="image_crs" class="form-title-small"> Changement de la vignette du cours</label>
				<br>
				<input type="file" id="image_crs" name="image_crs">
			</div>

			<!-- Add a file linked with the lesson -->
			<div class="form-group">
				<label for="link_support_mod" class="form-title-small">
					Ajouter des fichiers
				</label>
				<br>
				<input type="file" id="link_support_mod" name="link_support[]" multiple>
			</div>

			<!-- Edit a file linked with the lesson -->
			<div class="form-group {{ !empty($cours->supports[0]) ? 'to-hide' : '' }}" id="choose-new-statut">
				<h4 class="form-title">Choisir le status des fichiers des fichiers</h4>
				@forelse ( $cours->supports as $support )

				<div class="row justify-content-start">
					<div class="col-auto">
						{{ $support->name }}
					</div>
					<div class="col-auto">
						<div class="form-group">
							<select class="form-control form-control-sm" name="visibility_change[{{ $support->id }}]">
								<option value="0" {{ $support->visibility == 0 ? 'selected' : ' '}}>Public</option>
								<option value="1" {{ $support->visibility == 1 ? 'selected' : ' '}}>Privé</option>
								<option value="2">Supprimer</option>
							</select>
						</div>
					</div>
				</div>
				@empty

				@endforelse
			</div>

			<!-- Edit the dates of the lesson -->
			<h4 class="form-title">Dates du cours</h4>
			<div class="row justify-content-around dates-select">
				<div class="col-md-auto">
					<label class="form-title-small">
						Dates en présentiels
					</label>
					<div class="dates-pres">
						<div id="calendar-pres-upd">
							<div id="cal-pres-dates-upd">

							</div>
						</div>
					</div>
				</div>

				<div class="col-md-auto">
					<label class="form-title-small">
						Dates en distanciels
					</label>
					<div class="dates-dist">
						<div id="calendar-dist-upd">
							<div id="cal-dist-dates-upd">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="dates-select">
			</div>

			<!-- Button to edit the lesson -->
			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<button id="submit-btn-edt-crs" type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
			</div>
		</form>
	</div>
</div>

<script>
	var elePresUpd = document.getElementById('calendar-pres-upd');
	if (elePresUpd) {
		elePresUpd.style.visibility = "visible";
	}

	var eleDistUpd = document.getElementById('calendar-dist-upd');
	if (eleDistUpd) {
		eleDistUpd.style.visibility = "visible";
	}

	var calendarPresUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values: []
	});

	var calendarDistUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values: []
	});

	// Search the dates and make them appear into the calendar
	var dateList = '{{ $cours->dates }}'.split("},");
	$.each(dateList, function(key, value) {
		var splitedObj = value.split("&quot;");
		if (splitedObj[4] === ":1,")
			calendarPresUpd.values.push(new Date(splitedObj[7]));
		else if (splitedObj[4] === ":0,")
			calendarDistUpd.values.push(new Date(splitedObj[7]));
	});

	calendarPresUpd.appendTo('#cal-pres-dates-upd');
	calendarDistUpd.appendTo('#cal-dist-dates-upd');

	$('#submit-btn-edt-crs').click(function() {
		parseDate(calendarDistUpd.values, 'dates_dist');
		parseDate(calendarPresUpd.values, 'dates_pres');
	});
</script>
@endsection
