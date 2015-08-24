<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //TODO  data input validation

        $fullname = $this->ask('New user full name: ');
        $username = $this->ask('New user\'s username: ');
        $email = $this->ask('New user\'s email: ');

        $password = $this->secret('Password: ');
        $conPassword =  $this->secret('Confirm password: ');

        if($password !== $conPassword){
            $this->error('Passwords entered does not match');
            return ;
        }

        $user = new User([
            'fullname'=>$fullname,
            'username'=>$username,
            'email'=>$email,
            'password'=>$password
        ]);

        if($user->save())
            $this->comment('New user created !!');
        else
            $this->error('User creation failed!! ');
    }
}
