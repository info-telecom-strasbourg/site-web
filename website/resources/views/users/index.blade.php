@extends('layouts.layout')

@section('title', 'Liste des membres')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Membres</li>
@endsection

@section('content')

<div class="container">
	<h1 class="title lg text-center">
        Membres
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
    	<!-- Search bar -->
    	<form>
			<div class="input-group md-form form-sm form-2 pl-0">
				<input class="form-control my-0 py-1 lime-border" type="search" name=search placeholder="Rechercher" aria-label="Rechercher">
				<button class="input-group-append input-group-text lime lighten-2 btn btn-search" type="submit">
					<i class="fas fa-search text-grey" aria-hidden="true"></i>
				</button>
			</div>
		</form>

		<p class="total-members">Membres : {{ $all_users->count() }}</p>

		<div class="container pt-5">
			<div class="row">

				@if(isset($users))

					@forelse ($users as $user)
						<div class="col-md-3 text-center">
							<a href="#" class="respo">
					            <img class="profil-rounded" src="images/defaut/profil.jpg">
					            <p id="nom">{{ $user->name }}</p>
					            <p id="fonction">{{ $user->role->role }}</p>
					        </a>
						</div>

					@empty

						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucun membres n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>
					@endforelse

				@else
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun membres n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
					</div>
				@endif
			</div>
			<div class="row justify-content-center link-margin-top">
				<!-- Pagination links -->
				{{ $users->links() }}
			</div>
		</div>

    </div>
</div>

@endsection