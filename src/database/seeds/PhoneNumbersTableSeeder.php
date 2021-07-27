<?php

use Illuminate\Database\Seeder;
use App\Models\PhoneNumber;
use App\Models\User;

class PhoneNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $users = User::all();

        $faker = Faker\Factory::create();

        foreach ($users as $user) {
            PhoneNumber::firstOrCreate([
                    'user_id' => $user->id,
                    'phone_number' => $faker->regexify('(06)[0-9]{9}'),
                ]);
            }
        }
    }
