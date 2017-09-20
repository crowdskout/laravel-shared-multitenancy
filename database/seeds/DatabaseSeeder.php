<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 8 users
        $users = factory(App\User::class, 8)->create(); // default password is 'secret'

        // Create 4 customers
        $customers = factory(\App\Customer::class, 4)->create();

        $sources = [];

        $count = 0;
        foreach ($customers as $customer) {
            // Attach users to the customers
            \App\CustomerUser::insert([
                [
                    'customer_id' => $customer->id,
                    'user_id' => $users[$count++]->id
                ],
                [
                    'customer_id' => $customer->id,
                    'user_id' => $users[$count++]->id
                ]
            ]);

            $source1 = new \App\Source();
            $source1->name = "{$customer->name} Web Data";
            $source1->save();

            $source2 = new \App\Source();
            $source2->name = "{$customer->name} Imported Data";
            $source2->save();

            // Attach sources to customers
            \App\CustomerSource::insert([
                [
                    'customer_id' => $customer->id,
                    'source_id' => $source1->id
                ],
                [
                    'customer_id' => $customer->id,
                    'user_id' => $source2->id
                ]
            ]);

            // Save the sources for profile creation
            $sources[] = $source1;
            $sources[] = $source2;
        }

        // Create 1000 names with profile ids
        $nameInserts = factory(App\Name::class, 1000)->make()->toArray();

        $emailInserts = [];
        $nameInserts2 = [];
        foreach ($nameInserts as &$name) {
            $sourceId = $sources[rand(0, count($sources) - 1)]->id; // get a random source

            // Attach source id to the name
            $name['source_id'] = $sourceId;

            // Use name to create emails
            $email = [
                'email' => "{$name['first']}.{$name['last']}@test.com",
                'profile_id' => $name['profile_id'],
                'source_id' => $sourceId
            ];
            $emailInserts[] = $email;

            if (rand(0,2) === 2) {
                $sourceId = $sourceId % 2 === 0 ? $sourceId - 1 : $sourceId + 1;

                $anotherName = $name;
                $anotherName['source_id'] = $sourceId;
                if (rand(0,1) === 1) {
                    $anotherName['first'] = null;
                } else {
                    $anotherName['last'] = null;
                }
                $nameInserts2[] = $anotherName;

                $email['email'] = "{$name['first']}.{$name['last']}@example.com";
                $email['source_id'] = $sourceId;
                $emailInserts[] = $email;
            }
        }

        // Save the names and emails
        \App\Name::insert(array_merge($nameInserts, $nameInserts2));
        \App\Email::insert($emailInserts);
    }
}
