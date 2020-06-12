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
						<input class="form-control" type="text" value="{{ $pole->title }}" id="title" name="title">
					</div>
				</div>

				<!-- Decription -->
				<div class="form-group">
					<label class="label" for="desc">Decription</label>
					<div class="control">
						<textarea class="form-control" id="desc" name="desc" rows="3">{{ $pole->desc }}</textarea>
					</div>
				</div>

				<!-- Bouton submit -->

				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-rounded">Edit</button>
				</div>

			</form>
		</div/>
    </div>
</div>
@endsection
