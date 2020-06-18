@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ $pole->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <h4 class="title md text-left">Edition</h4>
			<form action="/poles/{{ $pole->id }}" method="POST">
				@csrf
				@method('PUT')

				<!-- Titre -->
				<div class="form-group">
					<label class="label" for="title">Titre</label>
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
					<label class="label" for="desc">Decription</label>
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
					<button type="submit" class="btn btn-primary btn-rounded">Edit</button>
				</div>

			</form>
		</div/>
    </div>
</div>
@endsection
