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
	
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
