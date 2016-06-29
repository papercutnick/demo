<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','netid','first_name','last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The groups that user owns.
     */
    public function groupsAsOwner()
    {
        return $this->belongsToMany('App\Group','group_owner')->withTimestamps();
    }

    /**
     * The groups that user belongs to.
     */
    public function groupsAsMember()
    {
        return $this->belongsToMany('App\Group','group_member')->withTimestamps();
    }
}
