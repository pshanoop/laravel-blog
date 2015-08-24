<?php

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
        //Creates a user with user name admin and password demo

        $user = factory(App\User::class,1)->create();
    }
}
