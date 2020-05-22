<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::Create();
        for($i=1;$i<=100;$i++){
            Customer::create([
                'first_name'=>$faker->firstName,
                'last_name'=>$faker->lastname,
                'email'=>$faker->unique()->safeEmail,
                'phone'=>$faker->unique()->phoneNumber,
                'address'=>$faker->address,
                'user_id'=>1
            ]);
        }

    }
}
