<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Registry;
use App\Models\User;

class RegistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $set = 100; //Set to 100000

        for ($i=0; $i < $set; $i++) {
            $new_registry = new Registry();

            $company_name = $faker->company();
            $company_check = Registry::where('company_name', $company_name)->first();
            while($company_check){
                $company_name = $faker->company();
                $company_check = Registry::where('company_name', $company_name)->first();
            };
            $new_registry->company_name = $company_name;

            $new_registry->address = $faker->streetAddress();
            $new_registry->postcode = $faker->randomNumber(5, true);
            $new_registry->city = $faker->city();
            $new_registry->district = $faker->city();
            $new_registry->region = $faker->state();

            $email = $faker->companyEmail();
            $email_check = Registry::where('email', $email)->first();
            while($email_check){
                $email = $faker->companyEmail();
                $email_check = Registry::where('email', $email)->first();
            };
            $new_registry->email = $email;

            $new_registry->save();
        }
    }
}
