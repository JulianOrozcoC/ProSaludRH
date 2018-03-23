<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    /**
    * Get the customers user instance.
    *
    * @return MorphOne
    */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

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
}
