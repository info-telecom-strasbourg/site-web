@extends('layouts.layout')

@section('title')
Modification d'un cours
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Modification du cours: {{ $cours->title }}
	</h1>
	<form class="" action="/poles/cours/{{ $cours->id }}" method="POST" enctype="multipart/form-data">
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
				<textarea class="form-control desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="5" required>{{ $cours->desc }}</textarea>
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
    				<label for="{{ $support->name }}">{{ $support->name }}</label>
				</div>
			@empty
			<div>
				Il n'y a aucun support pour ce cours.
			</div>
			@endforelse
		</div>

		<!-- Modifier les dates -->
		<div class="dates-select">
			<h4 class="title lg text-left">
				Dates en présentiels
			</h4>
			<div class="dates-pres">
				<div id="calendar-pres-upd">
		        	<div id="cal-pres-dates-upd">

		        	</div>
    			</div>
			</div>

			<h4 class="title lg text-left">
				Dates en distanciels
			</h4>
			<div class="dates-dist">
				<div id="calendar-dist-upd">
		        	<div id="cal-dist-dates-upd">

		        	</div>
    			</div>
			</div>
		</div>

		<div id="dates-crs">

		</div>


		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
			<button id="submit-btn-edt-crs" type="submit" class="btn btn-primary btn-rounded">Edit</button>
		</div>
	</form>
</div>
<script>
	var elePresUpd = document.getElementById('calendar-pres-upd');
	if(elePresUpd)
	{
		elePresUpd.style.visibility = "visible";
	}

	var eleDistUpd = document.getElementById('calendar-dist-upd');
	if(eleDistUpd)
	{
		eleDistUpd.style.visibility = "visible";
	}

	var calendarPresUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values:[]
	});

	var calendarDistUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values:[]
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
