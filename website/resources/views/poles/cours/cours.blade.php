@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Nom Cours
        </h1>
        <hr class="line-under-title">
        <div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <h4 class="title md text-left">Créateurs du cours</h4>
			<!-- Forelse sur les Créateurs -->
			<div class="container pt-5">
				<div class="row">
						<div class="col-md-auto sep-items">
							<img src="/images/projets/Objection.png" class="profil-rounded"/>
							Pseudo1
						</div>
						<div class="col-md-auto sep-items">
							<img src="/images/projets/Objection.png" class="profil-rounded"/>
							Pseudo1
						</div>
						<div class="col-md-auto sep-items">
							<img src="/images/projets/Objection.png" class="profil-rounded"/>
							Pseudo1
						</div>
						<div class="col-md-auto sep-items">
							<img src="/images/projets/Objection.png" class="profil-rounded"/>
							Pseudo1
						</div>
						<div class="col-md-auto sep-items">
							<img src="/images/projets/Objection.png" class="profil-rounded"/>
							Pseudo1
						</div>
						<div class="col-md-auto sep-items">
							<img src="/images/projets/Objection.png" class="profil-rounded"/>
							Pseudo1
						</div>
				</div>
			</div>


			<h4 class="title md text-left">Dates</h4>
			<div class="container-fluid">
				<div class="row">
					<div class="col-2">
						<img src="/images/projets/Objection.png" alt="Nouveau !" width=100px height=100px />
					</div>
					<div class="col">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
					</div>
				</div>
			<div>

			<h4 class="title md text-left">Références</h4>

			<h4 class="title md text-left">Support</h4>

			<!-- Bouton pour DL le support -->
			<div class="p-2 bd-highlight"><input class="btn btn-rounded btn-primary" type="button" value="TÉLÉCHARGE LE SUPPORT"></div>
        </div>
    </div>
</div>
@endsection
