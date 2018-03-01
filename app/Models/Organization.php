<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Organization extends Model
{
    use SoftCascadeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $softCascade = ['users'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
