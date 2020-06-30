@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ $pole->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $pole->desc }}</p>
            <h4 class="title md text-left">Liste des compétitions</h4>
			<div class="container pt-5">
				@forelse ($compets as $compet)
					<div class="row align-items-center">
						<div class="col-auto sep-chevr">
							<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
							</i>
						</div>
						<div class="col sep-chevr">
							<a href="/poles/cours/{{ $compet->id }}" class="link-black">{{ $compet->title }}</a>
						</div>
					</div>
				@empty
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucune compétitions n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endforelse
			</div>
	    </div>
	</div>
</div>
@endsection

<!--
$images = json_decode($compet->images)      là j'ai mes images
$images[0] pour 1ère images
$images[1] = "nouveauChemin"

$compet->images = tojson(MonArray)
 -->
