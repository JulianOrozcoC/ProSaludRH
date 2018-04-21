<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use App\Models\TestApplication;

class Test extends Model
{

    protected $fillable = [
        'name'
    ];

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'credits')->withPivot('amount');
    }

    public function testAplications()
    {
    	return $this->hasMany(TestApplication::class);
    }
}
