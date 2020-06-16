@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title title-page lg text-center">
            {{ $cours->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $cours->desc }}</p>
            <h4 class="title md text-left">Créateurs du cours</h4>
			<!-- Forelse sur les Créateurs -->
			<div class="container pt-5">
				<div class="row">
					@if(isset($cours))

						@forelse ($cours->creators as $creator)
							<div class="col-md-auto sep-items">
								<a href="#" class="link-member">
									<img src="/images/projets/Objection.png" class="profil-rounded"/>
									{{ $creator->name }}
								<a/>
							</div>
						@empty
							<h4 class="title md text-center">Ce cours a été créé par un anonyme</h4>
						@endforelse

					@else
						<h4 class="title md text-center">Ce cours n'existe pas</h4>
					@endif
				</div>
			</div>


			<h4 class="title md text-left">Dates</h4>
			<div class="container-fluid">
				<div class="row">
					@if(isset($cours))

						@forelse ($cours->dates as $date)
							<div class="col-2-auto align-self-center">
								<img src="/images/projets/Objection.png" alt="Nouveau !" width=100px height=100px />
							</div>
							<div class="col-auto align-self-center">{{ $date->date }}</div>
							<div class="w-100"></div>
							@empty
								<h4 class="title md text-center">Aucune date de prévue</h4>
						@endforelse

					@else
						<h4 class="title md text-center">Aucune date de prévue</h4>
					@endif
				</div>
			</div>
    </div>
</div>
@endsection

<!--
Dossier comme pour cours avec index/show/create (si on est le respo).....
 -->
