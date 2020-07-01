@extends('layouts.layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Pôle {{ ucfirst($pole->title) }}</li>
@endsection

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ ucfirst($pole->title) }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $pole->desc }}</p>
            <h4 class="title md text-left">Liste des cours</h4>
			<div class="container">
				<div class="container pt-5">
					<div class="row justify-content-center">

						@if(isset($cours))
							@forelse ($cours as $cour)

								<div id="proj-card" class="col-md-auto sep-items">
									<div class="card text-center rounded">
										<img class="card-img-top" src="{{ asset(json_decode($cour->image)[0]) }}" alt="Card image cap">
										<div class="card-body d-flex flex-column">
											<h5 class="card-title text-center font-weight-bold">
												{{ $cour->title }}
											</h5>
											<p class="card-text">
												<span>{{ mb_strlen( $cour->desc ) > 57 ? mb_substr($cour->desc, 0, 54) . ' ...' : $cour->desc }}
				                                </span>
											</p>
											<a href="/poles/cours/{{ $cour->id }}" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
										</div>
								  	</div>
								</div>
							@empty

								<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
									Aucun cours n'a été trouvé
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    					<span aria-hidden="true">&times;</span>
				  					</button>
								</div>
							@endforelse

						@else
							<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
								Aucun cours n'a été trouvé
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    					<span aria-hidden="true">&times;</span>
			  					</button>
							</div>

						@endif
					</div>
				</div>
			</div>

			@if(isset($cours) && $cours->count() > 6)
		        <div id="line-btn-vp" class="d-flex justify-content-center">
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		        </div>
			@endif

			@can ('create', 'App\Cours')
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<a class="btn btn-primary btn-rounded" href="/poles/cours/create">Créer un cours</a>
				</div>
			@endcan
			@can ('update', $pole)
				<div class="text-center" style="margin-top:25px; margin-bottom:25px;">
					<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/{{ $pole->id }}/edit'">Éditer</button>
				</div>
			@endcan

	    </div>
	</div>
</div>
@endsection
