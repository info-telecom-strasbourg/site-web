@extends('layouts.layout')

@section('title', 'Édition d\'un pôle')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/cours">Pôle {{ strtolower($pole->title) }}</a></li>
<li class="breadcrumb-item active">Édition</li>
@endsection

@section('content')
<div class="container">
    <h1 class="title lg text-center">
        Édition pôle {{ strtolower($pole->title) }}
    </h1>
    <hr class="line-under-title">
    
    <div class="container pt-3">
    	<form action="/poles/{{ $pole->id }}" method="POST">
    		@csrf
    		@method('PUT')

    		<!-- Titre -->
    		<div class="form-group">
    			<label class="form-title-small" for="title">Titre</label>
    			<div class="control">
    				<input class="form-control @error('title') is-invalid @enderror" type="text" value="{{ $pole->title }}" id="title" name="title" required>
    			</div>
    		</div>
    		@error('title')
    		<span class="invalid-feedback" role="alert">
    			<strong>{{ $message }}</strong>
    		</span>
    		@enderror

    		<!-- Decription -->
    		<div class="form-group">
    			<label class="form-title-small" for="desc">Decription</label>
    			<div class="control">
    				<textarea class="form-control desc @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required>{{ $pole->desc }}</textarea>
    			</div>
    		</div>
    		@error('desc')
    		<span class="invalid-feedback" role="alert">
    			<strong>{{ $message }}</strong>
    		</span>
    		@enderror

    		<!-- Bouton submit -->
    		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
    			<button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
    		</div>

    	</form>
	</div/>
</div>
@endsection
