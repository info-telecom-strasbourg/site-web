<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /**
     * Not mass assignable attributes. 
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Gets the project leader.
     */
    public function chef()
    {
        return $this->belongsTo('App\User', 'chef_projet_id');
    }

    /**
     * Gets the pole of project.
     */
    public function pole()
    {
        return $this->belongsTo('App\Pole');
    }

    /**
     * Gets the project partner.
     */
    public function collaborateur()
    {
        return $this->belongsTo('App\Collaborateur');
    }

    /**
     * Gets the projects participants.
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
        // if a search value has been specified, search if the a title or the
        // description has this value
        // otherwise return the query
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
        // if a pole was specified
        if (!empty(request()->pole)) {
            $query = $query->where('pole_id', request()->pole);
        }

        // if a user was specified
        if (!empty(request()->membre)) {
            $query = $query->join('projets_participants', 'projets.id', '=', 'projets_participants.projet_id')->where('user_id', request()->membre);
        }

        // if a partner was specified
        if (!empty(request()->partner)) {
            $query = $query->where('collaborateur_id', request()->partner);
        }

        // if a sort option was specified
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
