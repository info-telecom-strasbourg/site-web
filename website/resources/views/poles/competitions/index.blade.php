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
			<dl class="container">
				@foreach ($compets as $compet)
					<dt class="row align-items-center">
						<div class="col-auto sep-chevr">
							<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
							</i>
						</div>
						<div class="col sep-chevr">
							<a href="/poles/compétitions/{{ $compet->id }}" class="link-black">{{ $compet->title }}</a>
						</div>
                        <div class="col sep-chevr">
						</div>
					</dt>
                    <dd>
                        {{ $compet->desc }}
                    </dd>
				@endforeach
			</dl>
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
