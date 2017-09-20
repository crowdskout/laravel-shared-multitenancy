<?php

use Illuminate\Database\Seeder;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        if (empty($users)) {
            $this->call(UserSeeder::class);
            $users = \App\User::all();
        }

        $customers = \App\Customer::all();
        if (empty($customers)) {
            $this->call(CustomerSeeder::class);
            $customers = \App\Customer::all();
        }

        foreach ($users as $key => $user) {
            $customerIndex = $key % count($customers); // round robin attach users
            $user->customers()->attach($customers[$customerIndex]->id);
        }
    }
}
