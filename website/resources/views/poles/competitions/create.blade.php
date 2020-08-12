@extends('layouts.layout')

@section('title')
Création d'une compétition
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active"><a href="/poles/competitions">Pôle compétition</a></li>
<li class="breadcrumb-item active">Création</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
		Création d'une compétition
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<form id="creat-comp" action="{{ route('poles.competitions.store') }}" method="post" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label for="title" class="form-title-small">Nom</label>

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
					<textarea class="desc form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="5" required>{{ old('desc') }}</textarea>
				</div>

				@error('desc')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>

			<!-- Image principale -->
			<div class="form-group">
				<label for="cover" class="form-title-small">
					Image de couverture
				</label>
				<br>
				<input type="file" id="cover" name="cover" class="@error('cover') is-invalid @enderror" required>
				@error('desc')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>

			<div class="form-group">
				<div class="dates-select">
					<label class="form-title-small">
						Dates de compétitions
					</label>
					<div class="dates-comp">
						<div id="calendar-comp">
				        	<div id="cal-comp-dates">

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
				<input id="place" type="text" class="form-control" name="place" value="{{ old('place') }}">
			</div>

			<!-- Images secondaires -->
			<div class="form-group">
				<label for="images" class="form-title-small">
					Images (3 maximum)
				</label>
				<br>
				<input type="file" id="images" name="images[]" multiple>
			</div>

			<div class="form-group" style="margin-top: 40px;">
                <label class="sr-only form-title-small" for="website">Lien vers le site web</label>
                <div class="input-group mb-2">
	                <div class="input-group-prepend">
	                    <div class="input-group-text">
	                        <i class="fas fa-globe" style="font-size: 1rem;"></i>
	                    </div>
	                </div>
	                <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" placeholder="Lien vers le site web" value="{{ old('website') }}">
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

			<!-- Competiteurs -->
			<div class="form-group">
				<label for="competitors" class="form-title-small">Ajouter des competitors</label>
				<select class="custom-select" name="competitors[]" id="competitors" size="4" required multiple>
		            <option readonly selected hidden value="">participants</option>

		            @isset($users)
		                @foreach ($users as $user)
		                    <option value="{{ $user->id }}">{{ $user->name }}</option>
		                @endforeach
		            @endisset
		        </select>
			</div>

			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<button id="create-cpt" type="submit" class="btn btn-primary btn-rounded compet">AJOUTER</button>
			</div>

		</form>
	</div>
</div>
<script>
	var datesComp = document.getElementById('calendar-comp');
	if(datesComp)
	{
		datesComp.style.visibility = "visible";
	}
</script>
@endsection
