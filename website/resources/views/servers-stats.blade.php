<!-- Servers stats page -->
@extends('layouts.layout')

@section('title', 'Statistiques des serveurs ITS')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Statistiques des serveurs ITS</li>
@endsection

@section('content')

<style>
        .counter-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .counter {
            text-align: center;
            margin-top: 1.5em;
            margin-bottom: 1.5em;
            display: table-cell;
        }

        .counter h3 {
            margin-bottom: 1em;
            font-size: 1.5em;
        }

        .counter .count {
            margin-bottom: 0em;
            font-size: 3em;
            color: #0000FF;
        }

        .counter .details {
            margin-top: 1em;
        }

        .counter .gbits {
            font-size: 1em;
            color: #0000FF;
        }

        .section-title {
            font-size: 2.25em;
            margin-bottom: 1.5em;
            text-align: center;
        }

        hr {
            margin-top: 1em;
            margin-bottom: 1em;
            border: 1px solid #4472C4;
        }
    </style>

<div class="container">
	<h1 class="title lg text-center">
		Statistiques des serveurs ITS
	</h1>
	<hr class="line-under-title">
    <br><br>
    <p>Sur cette page, vous trouverez les principales statistiques sur nos serveurs, hébergés en salle des serveurs à TPS, 
        qui forment un <u>cluster redondant</u> faisant tourner tous les services que nous proposons.</p>
    <br>
	<div class="container pt-3">
        <h1 class="section-title">Section infrastructure</h1>
        <div class="counter-container">
            <div class="counter">
                <h3>Serveurs</h3>
                <h3 data-target=<?php echo $servers_count ?> class="count">0</h3>
                <div class="details">
                    @foreach($servers as $server)
                        @if ($server['public'] == 1)
                            <a>{{ $server['value'] }}</a><br>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>CPU (threads)</h3>
                <h3><span data-target=<?php echo $cpus ?> class="count" style="font-size: 2em">0</span>
                <span class="gbits" style="font-size: 1.3em">&nbsp;(</span>
                <span data-target=<?php echo $threads ?> class="count" style="font-size: 1.5em">0</span>
                <span class="gbits" style="font-size: 1.3em">)</span></h3>
            </div>
            <div class="counter">
                <h3>RAM</h3>
                <h3><span data-target=<?php echo $ram ?> class="count" style="font-size: 2em">0</span><span class="gbits"> Go</span></h3>
            </div>
            <div class="counter">
                <h3>Stockage</h3>
                <h3><span data-target=<?php echo $storage ?> class="count" style="font-size: 2em">0</span><span class="gbits"> To</span></h3>
            </div>
        </div>
        <br><br>
        <div class="counter-container">
            <div class="counter">
                <h3>VM</h3>
                <h3 data-target=<?php echo $vms_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($vms as $vm)
                    @if ($vm['public'] == 1)
                    <a>{{ $vm['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>LXC</h3>
                <h3 data-target=<?php echo $lxcs_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($lxcs as $lxc)
                    @if ($lxc['public'] == 1)
                    <a>{{ $lxc['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>Dockers</h3>
                    <h3 data-target=<?php echo $dockers ?> class="count">0</h3>
            </div>
            <div class="counter">
                <h3>PC</h3>
                <h3 data-target=<?php echo $pcs ?> class="count">0</h3>
            </div>
        </div>
        <br><hr><br>
        <h1 class="section-title">Section services</h1>
        <div class="counter-container">
            <div class="counter">
                <h3>Noms de domaine</h3>
                <h3 data-target=<?php echo $domains_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($domains as $domain)
                    @if ($domain['public'] == 1 && $domain['type'] == 'website')
                    <a>{{ substr($domain['value'],8) }}</a><br>
                    @endif
                    @if ($domain['public'] == 1 && $domain['type'] == 'domain')
                    <a>{{ $domain['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>Sous-domaines</h3>
                <h3 data-target=<?php echo $subdomains ?> class="count">0</h3>
            </div>
            <div class="counter">
                <h3>Services proposés</h3>
                <h3 data-target=<?php echo $services_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($services as $service)
                    @if ($service['public'] == 1)
                    <a>{{ $service['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>Sites web</h3>
                <h3 data-target=<?php echo $websites_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($websites as $website)
                    @if ($website['public'] == 1)
                    <a href="{{ $website['value'] }}">{{ substr($website['value'],8) }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <br><br>
        <div class="counter-container">
            <div class="counter">
                <h3>Serveurs DNS</h3>
                <h3 data-target=<?php echo $dns_servers ?> class="count">0</h3>
            </div>
            <div class="counter">
                <h3>Zones DNS</h3>
                <h3 data-target=<?php echo $dns_zones_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($dns_zones as $dns_zone)
                    @if ($dns_zone['public'] == 1)
                    <a>{{ $dns_zone['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>Jeux vidéos</h3>
                <h3 data-target=<?php echo $video_games_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($video_games as $video_game)
                    @if ($video_game['public'] == 1)
                    <a>{{ $video_game['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="counter">
                <h3>Utilisateurs NFS</h3>
                <h3 data-target=<?php echo $nfs_users_count ?> class="count">0</h3>
                <div class="details">
                    <b>Dont : </b><br>
                    @foreach($nfs_users as $nfs_user)
                    @if ($nfs_user['public'] == 1)
                    <a>{{ $nfs_user['value'] }}</a><br>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <br><hr><br>
        <h1 class="section-title">Section réseau</h1>
        <div class="counter-container">
            <div class="counter">
                <h3>Sous-réseaux IP</h3>
                <h3 data-target=<?php echo $networks ?> class="count">0</h3>
            </div>
            <div class="counter">
                <h3>VLAN</h3>
                <h3 data-target=<?php echo $vlans ?> class="count">0</h3>
            </div>
            <div class="counter">
                <h3>IPv4 publiques</h3>
                <h3><span data-target=<?php echo $ipv4s ?> class="count" style="font-size: 2em">0</span><span class="gbits"> /3</span></h3>
            </div>
            <div class="counter">
                <h3>IPv6 publiques</h3>
                <h3><span data-target=<?php echo $ipv6s ?> class="count" style="font-size: 2em">0</span><span class="gbits"> /2<sup>64</sup></span></h3>
            </div>
            <div class="counter">
                <h3>VPN</h3>
                <h3 data-target=<?php echo $vpns ?> class="count">0</h3>
            </div>
        </div>
        <br><br>
        <div class="counter-container">
            <div class="counter">
                <h3>Débit externe</h3>
                <h3><span data-target="1" class="count" style="font-size: 2em">0</span><span class="gbits"> Gbit/s</span></h3>
            </div>
            <div class="counter">
                <h3>Débit interne (max)</h3>
                <h3><span data-target="10" class="count" style="font-size: 2em">0</span><span class="gbits"> Gbits/s</span></h3>
            </div>
        </div>
    </div>
    <br><br>
    <p>Dernière mise à jour : {{ substr($last_update,0,10) }}</p>
</div>
    <script>
        const counters = document.querySelectorAll(".count");

        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }

        var loop = true;

        setTimeout(function () {
            loop = false;
        }, 400);

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