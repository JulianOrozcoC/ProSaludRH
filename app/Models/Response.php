<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TestApplication;


class Response extends Model
{
    //
    protected $fillable = [
        'question_number', 'question', 'answer', 'test_application_id',
           
    ];

    public function testApplication()
    {
    	return $this->belongsTo(TestApplication::class);
    }
}
