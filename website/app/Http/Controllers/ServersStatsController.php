<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServersStats;
use Illuminate\Support\Facades\DB;

class ServersStatsController extends Controller
{
    /**
     * Get data for welcome page.
     */
    public function stats()
    {
        // Return data
        $servers = DB::select('select * from servers_stats where type = "server" order by value asc');
        $servers = json_decode(json_encode($servers), true);
        $servers_count = count($servers);

        $websites = DB::select('select * from servers_stats where type = "website" order by value asc');
        $websites = json_decode(json_encode($websites), true);
        $websites_count = count($websites);
        
        $domains = DB::select('select * from servers_stats where type = "domain" or type = "website" order by value asc');
        $domains = json_decode(json_encode($domains), true);
        $domains_count = count($domains);

        $vms = DB::select('select * from servers_stats where type = "vm" order by value asc');
        $vms = json_decode(json_encode($vms), true);
        $vms_count = count($vms);

        $lxcs = DB::select('select * from servers_stats where type = "lxc" order by value asc');
        $lxcs = json_decode(json_encode($lxcs), true);
        $lxcs_count = count($lxcs);

        $nfs_users = DB::select('select * from servers_stats where type = "nfs_user" order by value asc');
        $nfs_users = json_decode(json_encode($nfs_users), true);
        $nfs_users_count = count($nfs_users);

        $services = DB::select('select * from servers_stats where type = "service" order by value asc');
        $services = json_decode(json_encode($services), true);
        $services_count = count($services);

        $video_games = DB::select('select * from servers_stats where type = "video-game" order by value asc');
        $video_games = json_decode(json_encode($video_games), true);
        $video_games_count = count($video_games);

        $dns_zones = DB::select('select * from servers_stats where type = "dns-zone" order by value asc');
        $dns_zones = json_decode(json_encode($dns_zones), true);
        $dns_zones_count = count($dns_zones);

        // Return counters
        $cpus = DB::table('servers_stats')->where('type', 'cpu')->first()->value;
        $threads = DB::table('servers_stats')->where('type', 'threads')->first()->value;
        $ram = DB::table('servers_stats')->where('type', 'ram')->first()->value;
        $storage = DB::table('servers_stats')->where('type', 'storage')->first()->value;
        $pcs = DB::table('servers_stats')->where('type', 'pc')->first()->value;
        $switches = DB::table('servers_stats')->where('type', 'switches')->first()->value;

        $ipv4s = DB::table('servers_stats')->where('type', 'ipv4')->first()->value;
        $ipv6s = DB::table('servers_stats')->where('type', 'ipv6')->first()->value;
        $vlans = DB::table('servers_stats')->where('type', 'vlan')->first()->value;
        $networks = DB::table('servers_stats')->where('type', 'network')->first()->value;
        $vpns = DB::table('servers_stats')->where('type', 'vpn')->first()->value;
        $dns_servers = DB::table('servers_stats')->where('type', 'dns-server')->first()->value;
        $dockers = DB::table('servers_stats')->where('type', 'docker')->first()->value;
        $subdomains = DB::table('servers_stats')->where('type', 'subdomains')->first()->value;


        $last_update = DB::table('servers_stats')->max('created_at');
        //return $last_update;

        return view('servers-stats', compact(
            'last_update', 'servers', 'servers_count', 
            'websites', 'websites_count', 'domains', 'domains_count', 
            'vms', 'vms_count', 'lxcs', 'lxcs_count',
            'ipv4s', 'ipv6s', 'vlans', 'networks', 'vpns',
            'nfs_users', 'nfs_users_count', 'video_games', 'video_games_count',
            'dns_zones', 'dns_zones_count', 'pcs', 'dns_servers',
            'cpus', 'threads', 'ram', 'storage', 'dockers', 'subdomains',
            'services', 'services_count', 'switches'
            ));
    }
}
