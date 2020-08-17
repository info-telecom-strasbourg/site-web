<button id="button-new-step" type="button" data-toggle="modal" data-target="#new-step" class="btn btn-primary">Ajouter une étape</button>
<div class="modal" id="new-step">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Nouvelle étape</h4>
				<button type="button" class="close" data-dismiss="modal" style="color: white;">
					<span>&times;</span> <!-- Cross button -->
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="/timeline/create/{{ $object->id }}">
					@csrf

					<!-- Give the step a decription -->
					<div class="form-group">
						<label for="desc" class="form-title-small">Description</label>

						<div class="control">
							<textarea class="desc form-control" id="desc" name="desc" rows="5" required>{{ old('desc') }}</textarea>
						</div>
					</div>
					<span id="desc-error" class="invalid-feedback" role="alert" style="display: none;">
						<strong>Il faut une description pour l'étape</strong>
					</span>

					<!-- Give a date to the step -->
					<div class="col-md-auto">
						<label class="form-title-small">
							Dates en pour l'étape
						</label>
						<div class="dates-step text-center">
							<div id="calendar-step">
								<div id="cal-step-dates">

								</div>
							</div>
						</div>
					</div>
					<div id="dates-select">
					</div>
					<span id="date-error" class="invalid-feedback" role="alert" style="display: none;">
						<strong>Il faut une date pour l'étape</strong>
					</span>


					<input type="text" name="reference_id" value="{{ $object->id }}" hidden>
					<input type="text" name="timeline_type" value="{{ get_class($object) }}" hidden>

					<button id="create-news-step" type="submit" class="btn btn-primary btn-rounded" style="margin-top:25px; margin-bottom:25px; width:100%;">Ajouter</button>
				</form>
			</div>
		</div>
	</div>
</div>
@foreach($object->timeline as $step)
	<button id="button-upd-step" type="button" data-toggle="modal" data-target="#upd-step" class="btn btn-primary">Édition de l'étape {{ $step->date }}</button>
	<div class="modal" id="upd-step">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Édition de l'étape {{ $step->date }}</h4>
					<button type="button" class="close" data-dismiss="modal" style="color: white;">
						<span>&times;</span> <!-- Cross button -->
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="/timeline/{{ $step->id }}/edit">
						@csrf
						@method('PUT')

						<!-- Give the step a decription -->
						<div class="form-group">
							<label for="desc{{ $step->id }}" class="form-title-small">Description</label>

							<div class="control">
								<textarea class="desc form-control" id="desc{{ $step->id }}" name="desc{{ $step->id }}" rows="5" required>{{ $step->desc }}</textarea>
							</div>
						</div>
						<span id="desc-error{{ $step->id }}" class="invalid-feedback" role="alert" style="display: none;">
							<strong>Il faut une description pour l'étape</strong>
						</span>

						<!-- Give a date to the step -->
						<div class="col-md-auto">
							<label class="form-title-small">
								Dates en pour l'étape
							</label>
							<div class="dates-step text-center">
								<div id="calendar-step-edt{{ $step->id }}" class="calendar-step-edt">
									<div id="cal-step-dates-edt{{ $step->id }}" class="cal-step-dates-edt">

									</div>
								</div>
							</div>
						</div>
						<div id="dates-select{{ $step->id }}">
						</div>
						<span id="date-error{{ $step->id }}" class="invalid-feedback" role="alert" style="display: none;">
							<strong>Il faut une date pour l'étape</strong>
						</span>

						<input type="text" name="reference_id" value="{{ $object->id }}" hidden>
						<input type="text" name="timeline_type" value="{{ get_class($object) }}" hidden>

						<button id="upd-step{{ $step->id }}" type="submit" class="btn btn-primary btn-rounded" style="margin-top:25px; margin-bottom:25px; width:100%;">Modification</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<a class="btn btn-rounded button-panel" href="/timeline/{{ $step->id }}/destroy">Supprimer</a>
@endforeach
<script>
var dateStep = document.getElementById('calendar-step');
if (dateStep) dateStep.style.visibility = "visible";

var calendarStep = new ej.calendars.Calendar({});
calendarStep.appendTo('#cal-step-dates');


$('button#create-news-step').click(function() {
	parseDate(calendarStep.value, 'date', '#dates-select');
});

// Search the dates and make them appear into the calendar
var datesSteps = [];
var calendars = [];
@foreach($object->timeline as $step)
	datesSteps.push(document.getElementById('calendar-step-edt{{ $step->id }}'));
	if(datesSteps[datesSteps.length - 1])
		datesSteps[datesSteps.length - 1].style.visibility = "visible";
	calendars.push(new ej.calendars.Calendar({}));

	calendars[calendars.length -1].value = new Date('{{ $step->date }}');
	calendars[calendars.length -1].appendTo('#cal-step-dates-edt{{ $step->id }}');

	$('button#upd-step{{ $step->id }}').click(function() {
		parseDate(calendars[calendars.length -1].value, 'date', '#dates-select{{ $step->id }}');
	});
@endforeach
</script>