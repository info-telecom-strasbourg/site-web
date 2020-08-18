<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for projects.
 */
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
	 *
	 * @return the chief of the project.
     */
    public function chef()
    {
        return $this->belongsTo('App\User', 'chef_projet_id');
    }

    /**
     * Gets the pole of project.
	 *
	 * @return the pole to with the project belongs.
     */
    public function pole()
    {
        return $this->belongsTo('App\Pole');
    }

    /**
     * Gets the project partner.
	 *
	 * @return all the collaborators of a project.
     */
    public function collaborateur()
    {
        return $this->belongsTo('App\Collaborateur');
    }

    /**
     * Gets the projects participants.
	 *
	 * @return all the participants of a project.
     */
    public function participants()
    {
        return $this->belongsToMany('App\User', 'projets_participants', 'projet_id', 'user_id')->orderBy('name');;
    }

    /**
     * Gets the comments of the project.
	 *
	 * @return the comments of the project.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    /**
     * Scope a query to only include researched projects.
	 * If a search value has been specified, search if the a title or the
	 * description has this value otherwise return the query.
     *
     * @param query: the query for the database search.
     * @return the project that match the scope.
     */
    public function scopeSearch($query)
    {
        return empty(request()->search) ? $query : $query->where('title', 'like', '%'.request()->search.'%')->orWhere('desc', 'like', '%'.request()->search.'%');
    }

    /**
     * Scope a query to only include filtered projects.
     *
     * @param query: the query for the database search.
     * @return the project that match the filter.
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
            else if (request()->trie == 3) {
                $query = $query->orderBy('projets.created_at', 'asc');
            }
            else {
                $query = $query->orderBy('projets.created_at', 'desc');
            }
        }

        return $query;
    }
}
