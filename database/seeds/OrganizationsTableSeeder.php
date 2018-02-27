<?php

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization = Organization::create(['name' => 'Aviato']);
        $organization = Organization::create(['name' => 'ProSalud']);
    }
}
