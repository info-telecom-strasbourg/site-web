<div style="display: flex; justify-content: center;"><button id="button-new-step" type="button" data-toggle="modal" data-target="#new-step" class="btn btn-primary btn-rounded">Ajouter un évènement</button></div>
<div class="modal" id="new-step">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Nouvel évènement</h4>
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
						<strong>Il faut une description pour l'évènement</strong>
					</span>

					<!-- Give a date to the step -->
					<div class="col-md-auto">
						<label class="form-title-small">
							Dates pour l'évènement
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
						<strong>Il faut une date pour l'évènement (une même date ne doit pas apparaître 2 fois)</strong>
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
	<div class="modal" id="upd-step{{ $step->id }}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Édition de l'évènement</h4>
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
								<textarea class="desc form-control" id="desc{{ $step->id }}" name="desc" rows="5" required>{{ $step->desc }}</textarea>
							</div>
						</div>
						<span id="desc-error{{ $step->id }}" class="invalid-feedback" role="alert" style="display: none;">
							<strong>Il faut une description pour l'évènement</strong>
						</span>

						<!-- Give a date to the step -->
						<div class="col-md-auto">
							<label class="form-title-small">
								Dates pour l'évènement
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
							<strong>Il faut une date pour l'évènement (une même date ne doit pas apparaître 2 fois)</strong>
						</span>

						<input type="text" name="reference_id" value="{{ $object->id }}" hidden>
						<input type="text" name="timeline_type" value="{{ get_class($object) }}" hidden>

						<button id="upd-step{{ $step->id }}" type="submit" class="btn btn-primary btn-rounded" style="margin-top:25px; margin-bottom:25px; width:100%;">Modification</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endforeach
<script>
/**
 * Display the error message in the span given and linked to the input
 * given.
 *
 * @param input: the input that contains the error.
 * @param errorSpan: the span that have to be displayed.
 */
function displayError(input, errorSpan)
{
	if(!input.hasClass('is-invalid'))
		input.addClass('is-invalid');
	$(errorSpan).css('display', 'block');
}
/**
 * Hide the error message in the span given and linked to the input
 * given.
 *
 * @param input: the input that do not contains error.
 * @param errorSpan: the span that have to be hid.
 */
function eraseError(input, errorSpan)
{
	if(input.hasClass('is-invalid'))
		input.removeClass('is-invalid');
	$(errorSpan).css('display', 'none');
}

/**
 * Check if the given date is unique. The date must come from a calendar like
 * the one in the modal for create an event.
 */
 function dateIsUnique(date, baseDate)
 {
	 var arrayDate = convertMonth(date);
	 var parsedDate = arrayDate[0] + '-' + arrayDate[1] + '-' + arrayDate[2];
	 var arrayBaseDate;
	 var parsedBaseDate;
	 if (!(baseDate === null))
	 {
		 arrayBaseDate = convertMonth(baseDate);
		 parsedBaseDate = arrayBaseDate[0] + '-' + arrayBaseDate[1] + '-' + arrayBaseDate[2];
	 }

	 @foreach($object->timeline as $step)
	 	if ('{{ $step->date }}' == parsedDate && !(baseDate === null) && parsedBaseDate != parsedDate)
			return false;
		else if(('{{ $step->date }}' == parsedDate) && baseDate === null)
			return false;
	 @endforeach
	 return true;
 }


var dateStep = document.getElementById('calendar-step');
if (dateStep) dateStep.style.visibility = "visible";

var calendarStep = new ej.calendars.Calendar({});
calendarStep.appendTo('#cal-step-dates');

/**
 * Validate the creation of timeline and display errors there is.
 */
$('button#create-news-step').click(function(e) {
	var error = false;
	var inputDesc = $('textarea#desc');
	var inputDate = $('div#calendar-step');

	if(inputDesc.val().length < 1)
	{
		error = true;
		displayError(intputDesc, 'span#desc-error');
	}
	else
		eraseError(inputDesc, 'span#desc-error');

	if(calendarStep.value == null || !dateIsUnique(calendarStep.value, null))
	{
		error = true;
		displayError(inputDate, 'span#date-error');
	}
	else
	{
		eraseError(inputDate, 'span#date-error');
		parseDate(calendarStep.value, 'date', '#dates-select');
	}

	if(error) e.preventDefault();
});

// Search the dates and make them appear into the calendar
var datesSteps = [];
var calendars = [];
var baseValues = [];
@foreach($object->timeline as $step)
	datesSteps.push(document.getElementById('calendar-step-edt{{ $step->id }}'));
	if(datesSteps['{{ $step->id }}'])
		datesSteps['{{ $step->id }}'].style.visibility = "visible";
	calendars['{{ $step->id }}'] = new ej.calendars.Calendar({});

	calendars['{{ $step->id }}'].value = new Date('{{ $step->date }}');
	baseValues['{{ $step->id }}'] = calendars['{{ $step->id }}'].value;
	calendars['{{ $step->id }}'].appendTo('#cal-step-dates-edt{{ $step->id }}');

	/**
	 * Validate the modification of timeline and display errors there is.
	 */
	$('button#upd-step{{ $step->id }}').click(function(e) {
		error = false;
		var inputDesc = $('textarea#desc{{ $step->id }}');
		var inputDate = $('div#calendar-step-edt{{ $step->id }}');

		if(inputDesc.val().length < 1)
		{
			error = true;
			displayError(inputDesc, 'span#desc-error{{ $step->id }}');
		}
		else
			eraseError(inputDesc, 'span#desc-error{{ $step->id }}');

		if(calendars['{{ $step->id }}'].value == null || !dateIsUnique(calendars['{{ $step->id }}'].value, baseValues['{{ $step->id }}']))
		{
			error = true;
			displayError(inputDate, 'span#date-error{{ $step->id }}');
		}
		else
		{
			eraseError(inputDate, 'span#date-error{{ $step->id }}');
			parseDate(calendars['{{ $step->id }}'].value, 'date', '#dates-select{{ $step->id }}');
		}

		if(error) e.preventDefault();
	});
@endforeach
</script>