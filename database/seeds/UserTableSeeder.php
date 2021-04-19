<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'=>'user',
            'last_name'=>'user',
            'email'=>'user@test.com',
            'password'=>bcrypt('12345678')
        ]);
    }
}
