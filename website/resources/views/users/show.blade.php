<!-- Display a user -->

@extends('layouts.layout')

@section('title', 'Membres ITS - '. $user->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="/users">Membres</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')

<div class="container">
    
    <!-- Name of the user -->
    <h1 class="title lg text-center">
        {{ $user->name }}
    </h1>
    <hr class="line-under-title">
</div>

@endsection
