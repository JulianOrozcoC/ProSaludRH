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
        $test = Test::Create(['name' => 'Test 1','type' => 1]);
        $test = Test::Create(['name' => 'Test 2','type' => 2]);
        $test = Test::Create(['name' => 'Test 3','type' => 3]);
        $test = Test::Create(['name' => 'Test 4','type' => 4]);
        $test = Test::Create(['name' => 'Test 5','type' => 5]);
    }
}
