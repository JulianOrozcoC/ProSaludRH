<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Test extends Model
{

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'credits')->withPivot('amount');
    }
}
