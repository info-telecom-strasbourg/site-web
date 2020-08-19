@extends('layouts.layout')

@section('title', 'Admin')

@section('breadcrumb')

@endsection

@section('content')

<style>
	#content {
		padding-bottom: 0;
	}
</style>


<section class="dark-page" id="vue-ens">
	<!-- Navbar dark version -->
	<div class="bandeau-dark">
		<div class="dropdown">
			<a class="btn btn-secondary dropdown-toggle total" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
				{{ Auth::user()->name }}
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="#">Profil</a>
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
					Déconnexion
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</div>

		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle short" type="button" data-toggle="dropdown">
				<img class="profil-rounded" src="{{ asset('storage/' . Auth::user()->profil_picture) }}">
			</button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="/users/{{ Auth::user()->id }}">Profil</a>
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
					Déconnexion
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</div>
	</div>
	<div class="nav flex-column nav-pills short" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
		<div class="navbar-dark-brand" href="/">
			<a href="/">
				<img src="/images/logo/logo-dark.png" width="90" height="100%" alt="Logo du site">
			</a>
		</div>
		<a class="nav-link" href="/page-admin/vue-ensemble">VUE D'ENSEMBLE</a>
		<a class="nav-link" href="/page-admin/membres">MEMBRES</a>
		<a class="nav-link active" href="#">ACTUALITÉS</a>
	</div>
	<div class="container">
		<div class="nav flex-column nav-pills total" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<div class="navbar-dark-brand" href="/">
				<a href="/">
					<img src="/images/logo/logo-dark.png" width="90" height="90" alt="Logo du site">
				</a>
			</div>
			<a class="nav-link" href="/page-admin/vue-ensemble">VUE D'ENSEMBLE</a>
			<a class="nav-link" href="/page-admin/membres">MEMBRES</a>
			<a class="nav-link active" href="#">ACTUALITÉS</a>
		</div>
		@php
		$nbNews = $allNews->count();
		@endphp
		<div class="tab-content" id="v-pills-tabContent" style="padding-bottom: 300px">
			<div class="tab-pane fade show active" id="v-pills-actu" role="tabpanel" aria-labelledby="v-pills-actu-tab">
				<h1 class="title lg text-center"> Actualités </h1>
				<hr class="line-under-title">
				<button id="button-new-news" type="button" data-toggle="modal" data-target="#new-news" class="btn btn-primary">Ajouter une actualité</button>
				<div class="modal" id="new-news">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Nouvelle news</h4>
								<button type="button" class="close" data-dismiss="modal" style="color: white;">
									<span>&times;</span> <!-- Cross button -->
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="/page-admin/news/create" enctype="multipart/form-data">
									@csrf

									<!-- Give the news a title -->
									<div class="form-group">
										<label for="title" class="form-title-small">Nom</label>

										<input id="title" type="text" class="form-control " name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

										<span id="title-error" class="invalid-feedback" role="alert" style="display: none;">
											<strong>Vous devez entrer un titre de plus de 3 caractères et moins de 255</strong>
										</span>
									</div>
									<!-- Give the news a decription -->
									<div class="form-group">
										<label for="desc" class="form-title-small">Description</label>

										<div class="control">
											<textarea class="desc form-control" id="desc" name="desc" rows="5" required>{{ old('desc') }}</textarea>
										</div>
									</div>

									<span id="desc-error" class="invalid-feedback" role="alert" style="display: none;">
										<strong>Il faut une description pour la news</strong>
									</span>
									<!-- Give the news a image -->
									<div style="display:flex;">
										<input id="image" type="file" name="image" accept="image/x-png,image/gif,image/jpeg" style="margin-left: auto; margin-right:auto;" required />
									</div>
									<span id="image-error" class="invalid-feedback" role="alert" style="display: none;">
										<strong>Il faut une image pour la news</strong>
									</span>

									<!-- Give the news a position -->
									<div class="form-group">
										<label for="position" class="form-title-small">Position</label>
										<select class="custom-select" id="position" name="position" required>

											@for($i = 1; $i <= $nbNews+1; $i++) <option value="{{ $i }}" @if($i==$nbNews+1) selected @endif>{{ $i }}
												</option>
												@endfor

										</select>
									</div>

									<!-- Give a link for the news -->
									<input type="checkbox" class="checkbox" id="links-nullable-create" name="links-nullable">
									<label for="links-links-nullable-create" style="margin-left: 10px;">Ajouter un lien</label>

									<div id="website-crt" class="form-group" style="margin-top: 40px; display: none">
										<label class="sr-only form-title-small" for="website">Lien du bouton</label>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fas fa-globe" style="font-size: 1rem;"></i>
												</div>
											</div>
											<input type="url" class="form-control" id="website" name="link" placeholder="Lien du bouton" value="{{ old('website') }}">
										</div>
									</div>
									<span id="website-error" class="invalid-feedback" role="alert" style="display: none;">
										<strong>Il faut un lien pour le bouton</strong>
									</span>
									<!-- Give the button a text -->
									<div id="button-crt" class="form-group" style="display: none;">
										<label for="button" class="form-title-small">Titre</label>

										<input id="button" type="text" class="form-control" name="button" value="{{ old('button') }}">
									</div>
									<span id="button-error" class="invalid-feedback" role="alert" style="display: none;">
										<strong>Il faut un message pour le bouton (moins de 255 caractères)</strong>
									</span>

									<button id="create-news-btn" type="submit" class="btn btn-primary btn-rounded" style="margin-top:25px; margin-bottom:25px; width:100%;">Ajouter</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="actu-container">
					@foreach($allNews as $news)
					@if($news->position != 1)
					<hr style="width: 100%; height: 1px; color: #b9b9b9; background-color: #b9b9b9; border: none; margin-top: 20px;">
					@endif
					<div class="title-actu">
						Actualité {{ $news->position }}
					</div>
					<div id="actu-{{ $news->id }}">
						<form id="form-edit" action="/page-admin/news/{{ $news->id }}/edit" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<!-- Image -->
							<div style="display:flex; flex-direction:column;">
								<img src="{{ asset('storage/' . $news->image) }}" alt="news picture">
								<input id="file{{ $news->id }}" type="file" name="image" accept="image/x-png,image/gif,image/jpeg" style="margin-left: auto; margin-right:auto;" />
							</div>

							<!-- Title -->
							<div class="form-group">
								<label for="title{{ $news->id }}" class="form-title-small">Titre</label>

								<input id="title{{ $news->id }}" type="text" class="form-control" name="title" value="{{ $news->title }}" required autofocus>
							</div>

							<span id="title-error{{ $news->id }}" class="invalid-feedback" role="alert" style="display: none;">
								<strong>Il faut choisir un titre</strong>
							</span>

							<!-- Description -->
							<div class="form-group">
								<label for="desc{{ $news->id }}" class="form-title-small">Description</label>

								<div class="control">
									<textarea class="desc form-control" id="desc{{ $news->id }}" name="desc" rows="5" required>{{ $news->desc }}</textarea>
								</div>
							</div>

							<span id="desc-error{{ $news->id }}" class="invalid-feedback" role="alert" style="display: none;">
								<strong>Il faut une description</strong>
							</span>

							<!-- Position -->
							<div class="form-group">
								<label for="position{{ $news->id }}" class="form-title-small">Position</label>
								<select class="custom-select" id="position{{ $news->id }}" name="position" required>

									@for($i = 1; $i <= $nbNews; $i++) <option value="{{ $i }}" @if($news->position == $i) selected @endif>{{ $i }}
										</option>
										@endfor

								</select>
							</div>

							<!-- Link -->
							<input type="checkbox" id="links-nullable" class="{{ $news->id }} checkbox" name="links-nullable" style="margin-top:20px;">
							<label for="links-nullable" style="margin-left: 10px;">Ajouter un lien</label>

							<div id="website{{ $news->id }}" class="form-group" style="margin-top: 40px; display: none">
								<!-- block -->
								<label class="sr-only form-title-small" for="website">Lien du bouton</label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fas fa-globe" style="font-size: 1rem;"></i>
										</div>
									</div>
									<input type="url" class="form-control" id="website{{ $news->id }}" name="link" placeholder="Lien du bouton" value="@isset($news->link) {{ $news->link }} @endisset">
								</div>
							</div>
							<span id="link-error{{ $news->id }}" class="invalid-feedback" role="alert" style="display: none;">
								<strong>Il faut un lien pour le bouton</strong>
							</span>

							<div id="button{{ $news->id }}" class="form-group" style="display: none;">
								<label for="button{{ $news->id }}" class="form-title-small">Titre</label>

								<input id="button{{ $news->id }}" type="text" class="form-control" name="button" value="@isset($news->button) {{ $news->button }} @endisset">
							</div>
							<span id="button-error{{ $news->id }}" class="invalid-feedback" role="alert" style="display: none;">
								<strong>Il faut un message pour le bouton</strong>
							</span>

							<div class="text-center" style="margin-top:25px; margin-bottom:25px; display:flex; flex-wrap: wrap; justify-content: center;">
								<button id="submit-btn-edt-news" type="submit" class="{{ $news->id }} btn btn-rounded button-panel">Enregistrer</button>
								<a class="btn btn-rounded button-panel" href="/page-admin/delete-news/{{ $news->id }}">Supprimer</a>
							</div>
						</form>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {
			var newsAll = {!! $allNews !!};
			$('input.checkbox').prop("checked", false);
			$('input.checkbox').prop("checked", false);

			/**
			 * Display or hide the sections corresponding to the button and the link
			 * of the news.
			 */
			$('input#links-nullable').click(function(e) {
				var newsId = $(this).attr('class').split(' ')[0];
				if ($(this).is(":checked")) {
					$('div#website' + newsId).css('display', 'block');
					$('div#button' + newsId).css('display', 'block');
				} else {
					$('div#website' + newsId).css('display', 'none');
					$('div#button' + newsId).css('display', 'none');
				}
			});

			$('input#links-nullable-create').click(function(e) {
				if ($(this).is(":checked")) {
					$('div#website-crt').css('display', 'block');
					$('div#button-crt').css('display', 'block');
				} else {
					$('div#website-crt').css('display', 'none');
					$('div#button-crt').css('display', 'none');
				}
			});

			/**
			 * Display the error message in the span given and linked to the input
			 * given.
			 *
			 * @param input: the input that contains the error.
			 * @param errorSpan: the span that have to be displayed.
			 */
			function displayError(input, errorSpan) {
				if (!input.hasClass('is-invalid'))
					input.addClass('is-invalid');
				$(errorSpan).css('display', 'block');
			}

			/**
			 * Hide the error message in the span given and linked to the input
			 * given.
			 *
			 * @param input: the input that do not contains error.
			 * @param errorSpan: the span that have to be hid.
			 */
			function eraseError(input, errorSpan) {
				if (input.hasClass('is-invalid'))
					input.removeClass('is-invalid');
				$(errorSpan).css('display', 'none');
			}



			/**
			 * Check if all the values are acceptable to edit a news.
			 */
			$('button#submit-btn-edt-news').click(function(e) {
				var newsId = $(this).attr('class').split(' ')[0];

				var inputTitle = $('input#title' + newsId);
				var inputDesc = $('textarea#decs' + newsId);
				var inputLink = $('input#website' + newsId);
				var inputButton = $('input#button' + newsId);

				var newsTitle = inputTitle.val();
				var newsDesc = inputDesc.val();
				var newsImage = $('input#file' + newsId)[0].files[0].name;
				var newsLinkNullable = $('input#links-nullable' + newsId).prop("checked", true);
				var newsLink = inputLink.val();
				var newsButton = inputButton.val();
				var error = false;

				if (newsTitle.length < 3) {
					error = true
					displayError(inputTitle, 'span#title-error' + newsId);
				} else
					eraseError(inputTitle, 'span#name-error' + newsId);

				if (newsDesc.length < 3) {
					error = true;
					displayError(inputDesc, 'span#desc-error' + newsId);
				} else
					eraseError(inputDesc, 'span#desc-error' + newsId);

				if (!newsLinkNullable) {
					if (newsLink.length < 1) {
						error = true;
						displayError(inputLink, 'span#link-error' + newsId);
					} else
						eraseError(inputLink, 'span#link-error' + newsId);

					if (newsButton.length < 1) {
						error = true;
						link
						displayError(inputButton, 'span#button-error' + newsId);
					} else
						eraseError(inputButton, 'span#button-error' + newsId);
				}

				if (error) e.preventDefault();
			});

			/**
			 * Check if all the values are acceptable to create a news.
			 */
			$('button#create-news-btn').click(function(e) {
				var inputTitle = $('input#title');
				var inputDesc = $('textarea#desc');
				var inputImage = $('input#image');
				var title = inputFile.val();
				var withLink = $('input#links-nullable').prop("checked", true);
				var inputWebsite = $('input#website');
				var inputButton = $('input#button');

				if (title.lenth < 3 || title.length > 255) {
					error = true;
					displayError(inputTitle, 'span#title-error');
				} else
					eraseError(inputTitle, 'span#title-error');

				if (inputDesc.val() < 1) {
					error = true;
					displayError(inputDesc, 'span#desc-error');
				} else
					eraseError(inputDesc, 'span#desc-error');

				if (!inputImage.val()) {
					error = true;
					displayError(inputImage, 'span#image-error');
				} else
					eraseError(inputImage, 'span#image-error');

				if (withLink) {
					if (inputWebsite.val() == null) {
						error = true;
						displayError(inputWebsite, 'span#website-error');
					} else
						eraseError(inputWebsite, 'span#website-error');

					if (inputButton.val() == null) {
						error = true;
						displayError(inputButton, 'span#button-error');
					} else
						eraseError(inputButton, 'span#button-error');
				}
				if (error) e.preventDefault();
			});
	});
</script>
@endsection