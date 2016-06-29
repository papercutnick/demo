<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];


    /**
     * Get the owners for the group.
     */
    public function owners()
    {
        return $this->belongsToMany('App\User','group_owner')->withTimestamps();
    }

    /**
     * Get the members for the group.
     */
    public function members()
    {
        return $this->belongsToMany('App\User','group_member')->withTimestamps();
    }
}
