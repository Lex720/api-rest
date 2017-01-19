<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Admin',
            'lastname'  => 'Admin',
            'email'     => 'admin@nextdots.com',
            'role'      => 'admin',
            'user'      => 'admin',
            'password'  => bcrypt('secret'),
        ]);
    }
}
