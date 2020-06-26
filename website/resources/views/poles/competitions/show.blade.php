@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            {{ $compet->title }}
        </h1>
        <hr class="line-under-title">
        <div>
            <p>{{ $compet->desc }}</p>
		</div>
    </div>
</div>
@endsection

<!--
Les dates
Les sources (links)
 -->
