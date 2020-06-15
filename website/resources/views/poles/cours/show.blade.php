@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            {{ $cours->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $cours->desc }}</p>
            <h4 class="title md text-left">Créateurs du cours</h4>
			<!-- Forelse sur les Créateurs -->
			<div class="container pt-5">
				<div class="row">
					@if(isset($cours))

						@forelse ($cours->creators as $creator)
							<div class="col-md-auto sep-items">
								<a href="#" class="link-member">
									<img src="/images/projets/Objection.png" class="profil-rounded"/>
									{{ $creator->name }}
								<a/>
							</div>
						@empty
							<h4 class="title md text-center">Ce cours a été créé par un anonyme</h4>
						@endforelse

					@else
						<h4 class="title md text-center">Ce cours n'existe pas</h4>
					@endif
				</div>
			</div>


			<h4 class="title md text-left">Dates</h4>
			<div class="container-fluid">
				<div class="row">
					@if(isset($cours))

						@forelse ($cours->dates as $date)
							<div class="col-2-auto align-self-center">
								<img src="/images/projets/Objection.png" alt="Nouveau !" width=100px height=100px />
							</div>
							<div class="col-auto align-self-center">{{ $date->date }}</div>
							<div class="w-100"></div>
							@empty
								<h4 class="title md text-center">Aucune date de prévue</h4>
						@endforelse

					@else
						<h4 class="title md text-center">Aucune date de prévue</h4>
					@endif
				</div>
			</div>
		<div>

			<h4 class="title md text-left">Références</h4>

			@if (isset ($cours->refs))
				<h4 class="title md text-left">Support</h4>
				<!-- Bouton pour DL le support -->
				<!-- TODO dans autres pages -->
				<div id="select-files">
					@foreach ($cours->refs as $ref)
					@if ($ref->visibility == 1)
					@auth
						<div>
							<input type="checkbox" id="file-select" name="{{ $ref->name }}">
							<label for="{{ $ref->name }}">{{ $ref->name }}</label>
						</div>
					@endauth
					@else
						<div>
							<input type="checkbox" id="file-select" name="{{ $ref->name }}">
							<label for="{{ $ref->name }}">{{ $ref->name }}</label>
						</div>
					@endif
					@endforeach

				</div>
				<div class="p-2 bd-highlight"><input id="download-sup" class="btn btn-rounded btn-primary" type="button" value="TÉLÉCHARGER LE SUPPORT"></div>
			@endif

        </div>
    </div>
</div>
@endsection

<!-- auth()->check() -->
