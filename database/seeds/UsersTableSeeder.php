<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization = Organization::where('name', 'Aviato')->first();

        $daniel = User::create(
            [
                'name' => 'Daniel Rodriguez',
                'password' => bcrypt('41149512'),
                'email' => 'danyrod94@gmail.com',
                'organization_id' => $organization->id,
                'created_at' => new Carbon,
                'updated_at' => new Carbon,
            ]
        );

        $daniel->assignRole('admin');
    }
}
