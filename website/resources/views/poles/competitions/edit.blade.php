@extends('layouts.layout')

@section('title')
Édition d'un cours
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active"><a href="/poles/competitions">Pôle compétition</a></li>
<li class="breadcrumb-item"><a href="/poles/competitions/{{ $compet->id }}">{{ $compet->title }}</a></li>
<li class="breadcrumb-item active">Édition</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Édition de la compétition : {{ $compet->title }}
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<form class="" action="/poles/competitions/{{ $compet->id }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<!-- Pour le titre -->
			<div class="form-group">
				<label for="title" class="form-title-small">Nom</label>

				<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $compet->title }}" required autocomplete="title" autofocus>

				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

			</div>

			<!-- Pour la description -->
			<div class="form-group">
				<label for="desc" class="form-title-small">Description</label>

				<textarea class="form-control desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="5" required>{{ $compet->desc }}</textarea>

				@error('desc')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror

			</div>

			<!-- Changer la couverture -->
			<div class="form-group">
				<label for="cover" class="form-title-small">
					Changer l'image de couverture
				</label>
				<br>
				<input type="file" id="cover" class="@error('cover') is-invalid @enderror" name="cover" accept="image/x-png,image/gif,image/jpeg">
				@error('cover')
					<span class="invalid-feedback" role="alert">
						<strong>Le fichier déposé doit être une image.</strong>
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
				<div id="dates-select">

				</div>
			</div>

			<!-- lieu -->
			<div class="form-group">
				<label for="place" class="form-title-small">Lieu où se déroulera la compétition (si aucun lieu n'est renseigné, la compétition sera considérée comme étant réalisable à distance)</label>
				<input id="place" type="text" class="form-control" name="place" value="{{ isset($compet->place) ? $compet->place : '' }}">
			</div>

			<!-- Modifier les images -->
			<div class="form-group">
				<label for="link_im_comp" class="form-title-small">
					Ajouter des images
				</label>
				<br>
				<input type="file" class="@error('link_im_comp') is-invalid @enderror" id="link_im_comp" name="link_im_comp[]" accept="image/x-png,image/gif,image/jpeg" multiple>
				@error('link_im_comp')
					<span class="invalid-feedback" role="alert">
						<strong>Les fichiers déposés doivent être des images.</strong>
					</span>
				@enderror
			</div>

			<!-- Pour enlever des images -->
			@if(isset($compet->images))
				<div class="form-group" id="choose-new-statut">
					<h4 class="form-title">Cochez les images à supprimer</h4>
		            <div class="form-group row align-items-center justify-content-around">
		                @foreach (json_decode($compet->images) as $key => $image)
							<div class="col-md-auto" style="display: flex; flex-direction:column; justify-content:center;">
								<div style="margin: 0 auto;">
									<img src="{{ asset('storage/' . $image) }}" alt=" {{ $key }} slide" style="height: 100px !important;">
								</div>
								<div class="custom-control custom-checkbox" style="margin: 0 auto; margin-bottom: 1rem;">
		                            <input id="im-cmpt-del-{{ $key }}" type="checkbox" name="remove_images[{{ $key }}]" class="custom-control-input" value="{{ $image }}">
									<label class="custom-control-label form-title-small" for="im-cmpt-del-{{ $key }}"></label>
								</div>
							</div> 
		                @endforeach
		            </div>
				</div>
			@endif

			<div class="form-group" style="margin-top: 40px;">
                <label class="sr-only form-title-small" for="website">Lien vers le site web</label>
                <div class="input-group mb-2">
	                <div class="input-group-prepend">
	                    <div class="input-group-text">
	                        <i class="fas fa-globe" style="font-size: 1rem;"></i>
	                    </div>
	                </div>
	                <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" placeholder="Lien vers le site web" value="{{ $compet->website }}">

                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

			<!-- Changer les participants -->
			<!-- competitors Ajout -->
			@if($compet->competitors->count() < $users->count())
				<div class="form-group">
					<label for="competitors" class="form-title-small">Ajouter des participants</label>

					<select class="custom-select" name="competitors[]" id="competitors" multiple>
			            	<option readonly selected hidden value="">Créateurs</option>

			            @isset($users)
			                @foreach ($users as $user)
								@if(!$compet->competitors->contains($user->id))
			                    	<option value="{{ $user->id }}">{{ $user->name }}</option>
								@endif
			                @endforeach
			            @endisset
			        </select>
			    </div>
			@endif

			<!-- Créateurs enlev -->
			@if($compet->competitors->count() > 0)
				<div class="form-group">
					<label for="del_competitors" class="form-title-small">Enlever des participants</label>

					<select class="custom-select" name="del_competitors[]" id="del_competitors" multiple>
			            	<option readonly selected hidden value="">Créateurs</option>

			            @isset($users)
			                @foreach ($users as $user)
								@if($compet->competitors->contains($user->id))
			                    	<option value="{{ $user->id }}">{{ $user->name }}</option>
								@endif
			                @endforeach
			            @endisset
			        </select>
			    </div>
			@endif

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
	var dateList = '{{ $compet->dates }}'.split("},");
	$.each(dateList, function(key, value) {
		var splitedObj = value.split("&quot;");
		calendarCompUpd.values.push(new Date(splitedObj[7]));
	});

	calendarCompUpd.appendTo('#cal-comp-upd');

	$('input#link_im_comp').val('');
	$('#submit-btn-edt-cmp').click(function(e) {
		var fileUpload = $('input#link_im_comp').get(0).files.length;
		var images = $('input#im-cmpt-del').length;
		var imToDel = $('input#im-cmpt-del:checked').length;
		var nbImg = images + fileUpload - imToDel;
		if((nbImg > 3))
		{
			e.preventDefault();
			$('input#link_im_comp').val('');
			alert("Le nombre d'image doit être inférieur à 3");
		}
		else
		{
			parseDate(calendarCompUpd.values, 'dates_comp', 'div#dates-select');
		}
	});

</script>
@endsection
