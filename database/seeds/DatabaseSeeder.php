<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $console = $this->command;

        $console->comment('Seeding started');

        Model::unguard();

        $this->call(UserTableSeeder::class);
        $console->comment('Admin user created');
        $console->error('Admin username: admin password: demo');

        $this->call(ArticleTableSeeder::class);
        $console->info('Ten articles created');

        Model::reguard();
        $console->comment('Seeding finished');
    }
}
