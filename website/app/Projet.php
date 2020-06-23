<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /**
     * Attributs qui ne sont pas assignables en masse.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Renvoie le chef de projet.
     */
    public function chef()
    {
        return $this->belongsTo('App\User', 'chef_projet_id');
    }

    /**
     * Renvoie le pole de projet.
     */
    public function pole()
    {
        return $this->belongsTo('App\Pole');
    }

    /**
     * Renvoie le collaborateur du projet.
     */
    public function collaborateur()
    {
        return $this->belongsTo('App\Collaborateur');
    }

    /**
     * Renvoie les utilisateurs participants au projet.
     */
    public function participants() 
    {
        return $this->belongsToMany('App\User', 'projets_participants', 'projet_id', 'user_id');
    }

    /**
     * Scope a query to only include researched projects.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query)
    {
        return empty(request()->search) ? $query : $query->where('title', 'like', '%'.request()->search.'%')->orWhere('desc', 'like', '%'.request()->search.'%');
    }

    /**
     * Scope a query to only include filtered projects.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query)
    {
        if (!empty(request()->pole)) {
            $query = $query->where('pole_id', request()->pole);
        }

        if (!empty(request()->membre)) {
            $query = $query->join('projets_participants', 'projets.id', '=', 'projets_participants.projet_id')->where('user_id', request()->membre);
        }

        if (!empty(request()->partner)) {
            $query = $query->where('collaborateur_id', request()->partner);
        }

        if (!empty(request()->trie)) {
            if (request()->trie == 1) {
                $query = $query->orderBy('title', 'asc');
            }
            else if (request()->trie == 2) {
                $query = $query->orderBy('title', 'desc');
            }
            else {
                $query = $query->orderBy('projets.created_at', 'asc');
            }
        }

        return $query;
    }
}
