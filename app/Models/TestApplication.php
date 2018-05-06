<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Response;
use App\Models\Test;

class TestApplication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expiry', 'completed_on', 'user_id', 'test_id',
         
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
    public function scopeActive($query)
    {
        return $query->whereNull('completed_on');
    }
    
    public function scopeComplete($query)
    {
        return $query->whereNotNull('completed_on');
    }
}
