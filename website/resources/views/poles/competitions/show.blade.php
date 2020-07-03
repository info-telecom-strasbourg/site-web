@extends('layouts.layout')

@section('title', 'Compétition ITS - ' . $compet->title)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/competitions">Pôle compétitions</a></li>
<li class="breadcrumb-item active">{{ $compet->title }}</li>
@endsection

@section('content')
<div class="container" id="cours">
	<h1 class="title lg text-center">
		{{ $compet->title }}
	</h1>
	<hr class="line-under-title">

	<div class="container pt-3">
		<div class="container" id="description" style="margin-top: 50px;">
			<div class="row">
				<div class="col-3 disp">
				</div>
				<div class="col-9 disp">
					<p>{{ $compet->desc }}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="bordure"></div>

	<!-- Compétiteurs -->
	<h4 class="title md text-center">Compétiteurs</h4>
	<div class="container" style="padding-top: 1rem !important; margin-bottom: -35px;">
		<div class="row align-items-center">
			@forelse ($compet->competitors as $competitor)
				<div class="col-md-auto sep-items">
					<a href="/users/{{ $creator->id }}" class="user-link">
						<div class="card p-2 rounded chef-projet" style="min-width: 220px !important; height: 100px !important; cursor: pointer;">
							<div class="row no-gutters align-items-center" style="flex-wrap: unset; height: 100% !important;">
								<div class="col-md-4" style="width: 60px !important;">
									<img src="{{ asset('storage/' . $competitor->profil_picture) }}" class="card-img profil-rounded" style="width: 60px !important; height: 60px !important;">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<h5 class="card-title" style="margin-bottom: 0;"> {{ $competitor->name }}</h5>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			@empty
				<div>
					Il n'y a aucun compétiteurs... Pour l'instant !
				</div>
			@endforelse
		</div>
	</div>
	<div class="bordure"></div>

	<div class="container" style="margin-top: 30px;">
		@forelse ($compet->dates as $date)
			<div class="row align-items-center">
				<div class="col-auto sep-chevr">
					<i id="chevron-date-supports" class="far fa-calendar-alt fa-2x">
					</i>
				</div>
				<div class="col sep-chevr">
					{{ \Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y') }}
				</div>
			</div>
		@empty
			<div>
				Aucune date n'a été renseignée pour cette compétition
			</div>
		@endforelse
	</div>
	<div class="bordure"></div>


	@can ('update', $compet)
		<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
			<a class="btn btn-primary btn-rounded" href="/poles/competitions/{{ $compet->id }}/edit">Modifier cette compétition</a>
		</div>
	@endcan
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
