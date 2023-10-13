<!-- Servers stats page -->
@extends('layouts.layout')

@section('title', 'Statut des serveurs ITS en temps réel')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Statut des serveurs ITS</li>
@endsection

@section('content')

<div class="container">
    <h1 class="title lg text-center">
        Statut des serveurs ITS en temps réel
    </h1>
    <hr class="line-under-title">
    <br><br>
    <p>Lien vers la page de statut : <a href="https://uptime.its-tps.fr/status/its" target="_blank">https://uptime.its-tps.fr/status/its</a></p>
    <iframe id="UptimeIframe" src="https://uptime.its-tps.fr/status/its" width="100%"></iframe>
    <script>
        // Selecting the iframe element
        var iframe = document.getElementById("UptimeIframe");

        // Adjusting the iframe height onload event
        iframe.onload = function() {
            iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
        }
    </script>
</div>

@endsection