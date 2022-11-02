<!-- Servers stats page -->
@extends('layouts.layout')

@section('title', 'Statistiques serveurs')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Statistiques serveurs</li>
@endsection

@section('content')

<style>
        .counter-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .counter {
            text-align: center;
            margin: 1.5em;
            width: 30%;
        }

        .counter h3 {
            margin-bottom: 1em;
        }

        .counter .count {
            font-size: 3em;
            color: #0000FF;
        }
    </style>

<div class="container">
	<h1 class="title lg text-center">
		Statistiques serveurs
	</h1>
	<hr class="line-under-title">
	<div class="container pt-3">
        <div class="counter-container">
            <div class="counter">
                <h3>Serveurs physiques</h3>
                <h3 data-target="4" class="count">0</h3>
            </div>
            <div class="counter">
                <h3>Noms de domaine</h3>
                <h3 data-target="7" class="count">0</h3>
            </div>
            <div class="counter">
                <h3>Sous-domaines</h3>
                <h3 data-target="25" class="count">0</h3>
            </div>
        </div>
        <br><br>
        <div class="counter-container">
            <div class="counter">
                <h3>VM</h3>
                <h3 data-target="10" class="count">0</h3>
            </div>
            <div class="counter">
                <h3>LXC</h3>
                <h3 data-target="3" class="count">0</h3>
            </div>
            <div class="counter">
                <h3>PC</h3>
                <h3 data-target="14" class="count">0</h3>
            </div>
        </div>
        <br><br>
        <div class="counter-container">
            <div class="counter">
                <h3>Sites web</h3>
                <h3 data-target="8" class="count">0</h3>
            </div>
            <div class="counter">
                <h3>Zones DNS</h3>
                <h3 data-target="6" class="count">0</h3>
            </div>
            <div class="counter">
                <h3>Services ITS</h3>
                <h3 data-target="30" class="count">0</h3>
            </div>
        </div>
        <br><br>
        <div class="counter-container">
            <div class="counter">
                <h3>Jeux vidéos</h3>
                <h3 data-target="3" class="count">0</h3>
            </div>
        </div>
    </div>
</div>
<script>
    const counters = document.querySelectorAll(".count");

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    var loop = true;

        setTimeout(function () {
            loop = false;
        }, 500);

    counters.forEach((counter) => {
        const updateCount = () => {
            const target = parseInt(+counter.getAttribute("data-target"));
            const count = parseInt(+counter.innerText);
            const increment = 1;

            if (loop) {
                counter.innerText = getRandomInt(200);
                setTimeout(updateCount, 50);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });
</script>

@endsection