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

			<!-- Dates en présentiels -->
			<h4 class="title md text-left">Dates en présentiels</h4>
			<div class="container">
					@if(isset($cours))
						@forelse ($cours->dates->where('presentiel', 1) as $date)
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

			<!-- Dates en distanciels -->
			<h4 class="title md text-left">Dates en distanciels</h4>
			<div class="container">
					@if(isset($cours))
						@forelse ($cours->dates->where('presentiel', 0) as $date)
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
			@if(isset($cours->links))
				<h4 class="title md text-left">Références</h4>
				@foreach (json_decode($cours->links, true) as $link)
				<div class="row align-items-center">
					<div class="col-auto sep-chevr">
						<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
						</i>
					</div>
					<div class="col sep-chevr">
						<a href="{{ $link }}" class="link-black" target="_blank">{{ $link }}</a>
					</div>
				</div>
				@endforeach
			@endif


			<!-- Supports -->
			@if (!empty($cours->supports[0]))
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
										<a class="link-black" href="/download/{{ $support->id }}">
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

			@can('update', $cours)
			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<a class="btn btn-primary btn-rounded" href="/poles/cours/{{ $cours->id }}/edit">Editer</a>
			</div>
			@endcan

		</div>
    </div>
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
