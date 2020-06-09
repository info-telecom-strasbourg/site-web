@extends('layouts.layout')

@section('title', 'Projets')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Projets</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
        Projets
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
    	<!-- Search bar -->
		<div class="input-group md-form form-sm form-2 pl-0">
			<input class="form-control my-0 py-1 lime-border" type="text" placeholder="Rechercher" aria-label="Rechercher">
				<div class="input-group-append">
					<span class="input-group-text lime lighten-2" id="basic-text1">
						<i class="fas fa-search text-grey" aria-hidden="true">
			        	</i>
			        </span>
				</div>
		</div>
    	<!-- Filter options -->
    	<div class="filter-options container">
    		<h2>Filtres</h2>
    		<div class="row">
    			<div class="col-md-3">
					<select class="form-control">
						<option disabled selected hidden>Pôle</option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control">
						<option disabled selected hidden>Membre</option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control">
						<option disabled selected hidden>Trié par</option>
					</select>
				</div>
				<div class="col-md-3 text-center">
					<button type="submit" class="btn btn-primary btn-primary btn-rounded">FILTRER</button>
				</div>
			</div>
		</div>

    </div>
</div>

@endsection