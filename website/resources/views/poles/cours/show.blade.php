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
			<!-- Créateurs -->
			<div class="container pt-5">
				<div class="row align-items-center">
					@if(isset($cours))
						@forelse ($cours->creators as $creator)
							<div class="col-md-auto sep-items">
								<a href="#" class="link-member">
									<img src="/images/projets/Objection.png" class="profil-rounded"/>
									{{ $creator->name }}
								<a/>
							</div>
						@empty
							<div>
								Ce cours a été créé par un anonyme
							</div>
						@endforelse
					@else
						<h4 class="title md text-center">Ce cours n'existe pas</h4>
					@endif
				</div>
			</div>


			<!-- Dates -->
			<h4 class="title md text-left">Dates</h4>
			<div class="container">
					@if(isset($cours))
						@forelse ($cours->dates as $date)
							<div class="row align-items-center">
								<div class="col-auto sep-chevr">
									<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
									</i>
								</div>
								<div class="col sep-chevr">
									{{ \Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y') }}
								</div>
							</div>
							@empty
								<div>
									Aucune date n'est prévue pour ce cours
								</div>
						@endforelse

					@else
						<div>
							Aucune date n'est prévue pour ce cours
						</div>
					@endif
			</div>


			<!-- Références -->
			<h4 class="title md text-left">Références</h4>


			<!-- Supports -->
			@if (isset ($cours->supports))
				<h4 class="title md text-left">Support</h4>
				<!-- Bouton pour DL le support -->
				<!-- TODO dans autres pages -->
				<div id="select-files" class="container">
					@foreach ($cours->supports as $support)
						<div class="row align-items-center">
							@if ($support->visibility == 1)
								@auth
									<div class="col-auto sep-chevr">
										<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x"></i>
									</div>
									<div class="p-2 bd-highlight col sep-chevr">
										<a class="link-black" href="/download/{{ $support->ref }}">
											{{ $support->name }}
										</a>
										<!-- En discuter avec Clara !!!! Pb pour télécharger -->
									</div>
								@endauth
							@else
								<div class="col-auto sep-chevr">
									<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x"></i>
								</div>
								<div class="p-2 bd-highlight col sep-chevr">
									<a class="link-black" href="/download/{{ $support->id }}">
										{{ $support->name }}
									</a>
								</div>
							@endif
						</div>
					@endforeach
				</div>
			@endif

		</div>
    </div>
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
