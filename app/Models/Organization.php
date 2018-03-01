<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Organization extends Model
{
<<<<<<< HEAD
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
=======
    protected $fillable = ['name'];
>>>>>>> 552a628cdade3675141ac684ed0b9d7167d8170f
}
