@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle {{ $pole->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $pole->desc }} </p>
            <h4 class="title md text-left">Projets</h4>

            <!-- ICI METTRE LE FORELSE -->
            {{--
            @forelse ($pole->projets as $projet)
                {{ $projet->title }}
            @empty
                Pas de projet disponible
            @endforelse --}}


            <div class="d-flex justify-content-center">
              <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
              <div class="p-2 bd-highlight"><input class="btn-rounded btn-primary" type="button" value="Voir-plus"></div>
              <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
            </div>
			<h4 class="title md text-left">Responsable {{ $pole->title }}</h4>
			{{ $pole->respo->name }}
        </div>
    </div>
</div>
@endsection
