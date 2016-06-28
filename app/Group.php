<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * Get the owners for the group.
     */
    public function owners()
    {
        return $this->belongsToMany('App\User','group_owner');
    }

    /**
     * Get the members for the group.
     */
    public function members()
    {
        return $this->belongsToMany('App\User','group_member');
    }
}
