<?php

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 1000 names with profile ids
        $nameInserts = factory(App\Name::class, 1000)->make()->toArray();

        $emailInserts = [];
        $nameInserts2 = [];
        foreach ($nameInserts as $name) {
            // Use name to create emails
            $email = [
                'email' => "{$name['first']}.{$name['last']}@test.com",
                'profile_id' => $name['profile_id']
            ];
            $emailInserts[] = $email;

            // add another name and email 1/3 of the time
            if (rand(0,2) === 2) {
                $anotherName = $name;
                if (rand(0,1) === 1) {
                    $anotherName['first'] = null;
                } else {
                    $anotherName['last'] = null;
                }
                $nameInserts2[] = $anotherName;

                $email['email'] = "{$name['last']}.{$name['first']}@example.com";
                $emailInserts[] = $email;
            }
        }

        // Save the names and emails
        \App\Name::insert(array_merge($nameInserts, $nameInserts2));
        \App\Email::insert($emailInserts);
    }
}
