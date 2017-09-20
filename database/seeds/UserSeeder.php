<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 8 users
        factory(App\User::class, 8)->create(); // default password is 'secret'
    }
}
