<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /**
     * Attributs assignables en masse
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Renvoie le chef de projet
     */
    public function chef()
    {
        return $this->belongsTo('App\User', 'chef_projet_id');
    }

    /**
     * Renvoie les utilisateurs participants au projet
     */
    public function participants() 
    {
        return $this->belongsToMany('App\User', 'projets_participants', 'projet_id', 'user_id');
    }

    /**
     * Renvoie le pole du projet
     */
    /*
    public function pole() 
    {
        return $this->belongsTo('App\Pole');   
    }
    */
}
