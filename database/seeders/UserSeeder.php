<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $new_admin = new User();
        $new_admin->name = 'Gabriele';
        $new_admin->last_name = 'Vadacca';
        $new_admin->email = 'g.vadacca@gadstudio.eu';
        $new_admin->password = Hash::make(12345678);
        $new_admin->save();
        $new_admin->givePermissionTo('all');

        $set = 50;

        for ($i=0; $i < $set; $i++) {
            $new_user = new User();
            $new_user->name = $faker->firstName();
            $new_user->last_name = $faker->lastName();

            $email = $faker->safeEmail();
            $email_check = User::where('email', $email)->first();
            while($email_check){
                $email = $faker->safeEmail();
                $email_check = User::where('email', $email)->first();
            };
            $new_user->email = $email;

            $new_user->password = Hash::make($faker->password(8));
            $new_user->save();
            $new_user->givePermissionTo($faker->randomElement(['edit', 'view']));
        }
    }
}
