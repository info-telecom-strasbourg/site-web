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
					<img src="{{ asset('storage/' . $compet->cover) }}" alt="Decriptive image">
				</div>
				<div class="col-9 disp">
					<p>{{ $compet->desc }}</p>
					<p>
						<a href="{{ $compet->website }}" class="link-black" target="_blank">Vers le site officiel</a>
					</p>
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
					<a href="/users/{{ $competitor->id }}" class="user-link">
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

<div class="row align-items-center">
	<div class="col">
		<h4 class="title md text-center">{{ $compet->dates->count() > 1 ? 'Dates' : 'Date' }}</h4>
	</div>
	<div class="col">
		<h4 class="title md text-center">Lieu</h4>
	</div>
	<div class="w-100"></div>
	<div class="col text-center">
		<div class="container" style="margin-top: 30px;">
			<div class="row justify-content-md-center">
				<div class="col-auto">
					@forelse ($compet->dates as $date)
					<div class="row align-items-center">
						<div class="col-md-auto sep-chevr">
							<i id="chevron-date-supports" class="far fa-calendar-alt fa-2x">
							</i>
						</div>
						<div class="col-md-auto sep-chevr">
							{{ \Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y') }}
						</div>
					</div>
					@empty
					<div>
						Aucune date n'a été renseignée pour cette compétition
					</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>
	<div class="col text-center">
		{{ isset($compet->place) ? $compet->place : 'Cette compétition se déroulera à distance' }}
	</div>
	<div class="w-100"></div>
</div>

	@if(isset($compet->images) && !empty(json_decode($compet->images)))
		<div class="bordure"></div>
		<h4 class="title md text-center">Photos de la compétition</h4>
		<div class="row align-items-center justify-content-around">
			@foreach(json_decode($compet->images) as $image)
				<div class="col-md-auto">
					<img src="{{ asset('storage/' . $image) }}" alt="Photo de la compétiton" class="photo-comp">
				</div>
			@endforeach
		</div>
	@endif

	@isset($compet->result)
		<div class="bordure"></div>
		<h4 class="title md text-center">Résultats</h4>
		<div>
			<p>
				@php
					$res = str_replace('\n', '<br>', $compet->result);
					echo $res;
				@endphp
			</p>
		</div>
	@endisset


	@can ('update', $compet)
		<div class="d-flex flex-row justify-content-around" style="margin-top: 25px;">
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<a class="btn btn-primary btn-rounded" href="/poles/competitions/{{ $compet->id }}/edit">Modifier cette compétition</a>
			</div>
			<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
				<a class="btn btn-primary btn-rounded" href="/poles/competitions/{{ $compet->id }}/destroy">Supprimer</a>
			</div>
		</div>
	@endcan


</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
