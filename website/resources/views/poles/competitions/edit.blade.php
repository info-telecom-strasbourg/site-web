@extends('layouts.layout')

@section('title')
Édition d'un cours
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active"><a href="/poles/competitions">Pôle compétition</a></li>
<li class="breadcrumb-item"><a href="/poles/competitions/{{ $competition->id }}">{{ $competition->title }}</a></li>
<li class="breadcrumb-item active">Édition</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Édition de la compétition : {{ $competition->title }}
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<form class="" action="/poles/competition/{{ $competition->id }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<!-- Pour le titre -->
			<div class="form-group">
				<label for="title" class="form-title-small">Nom</label>

				<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $competition->title }}" required autocomplete="title" autofocus>

				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

			</div>

			<!-- Pour la description -->
			<div class="form-group">
				<label for="desc" class="form-title-small">Description</label>

				<textarea class="form-control desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="5" required>{{ $competition->desc }}</textarea>

				@error('desc')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror

			</div>


			<!-- Modifier les dates -->
			<div class="form-group">
				<label class="form-title-small">
					Dates de compétitions
				</label>
				<div class="text-left">
					<div class="dates-comp">
						<div id="calendar-comp-upd">
							<div id="cal-comp-upd">

							</div>
						</div>
					</div>
				</div>
				<div id="dates-comp">

				</div>
			</div>

			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<button id="submit-btn-edt-cmp" type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
			</div>
		</form>
	</div>
</div>
<script>
	var eleCompUpd = document.getElementById('calendar-pres-upd');
	if(eleCompUpd)
	{
		eleCompUpd.style.visibility = "visible";
	}

	var calendarCompUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values:[]
	});

	// Search the dates and make them appear into the calendar
	//TODO retrouver les dates....

	calendarCompUpd.appendTo('#cal-comp-upd');

	$('#submit-btn-edt-cmp').click(function() {
		parseDate(calendarCompUpd.values, 'dates_comp');
	});

</script>
@endsection
