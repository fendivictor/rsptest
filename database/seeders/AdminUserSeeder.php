<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'fendivictor@gmail.com',
            'password' => bcrypt('1234'),
            'photo' => 'https://avatars0.githubusercontent.com/u/21212198?s=400&u=3e87e88119d2e39bbc6ace0d9012fc3e16789ca0&v=4'
        ]);
    }
}
