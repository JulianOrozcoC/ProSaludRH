<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\TestApplication;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftCascadeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'confirmed_on', 'organization_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $softCascade = ['testApplications'];

    /**
     * The organization to wich the user belongs.
     *
     * @var array
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function testApplications()
    {
        return $this->hasMany(TestApplication::class);
    }

    /**
     * Get the owning userable model.
     */
    public function userable()
    {
        return $this->morphTo();
    }
}
