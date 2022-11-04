<!-- Servers stats page -->
@extends('layouts.layout')

@section('title', 'Statuts des serveurs ITS')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Statuts des serveurs ITS</li>
@endsection

@section('content')

<iframe src="https://uptime.its-tps.fr/status/its" width="100%"></iframe>

@endsection