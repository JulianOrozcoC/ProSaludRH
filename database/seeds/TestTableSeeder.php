<?php

use Illuminate\Database\Seeder;
use App\Models\Test;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = Test::Create([
            'name' => 'Test 1',
            'type' => 1
        ]);
    }
}
