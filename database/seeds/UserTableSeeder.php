<?php

use App\Movement;
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
        $user = new User();
        $user->name = 'Daniel Romero';
        $user->email = 'Daniel@miaw';
        $user->password = bcrypt('secret');
        $user->save();

        for($i = 0; $i < 50; $i++){
            $user->movements()->save(factory(Movement::class)->make());
        }

        factory(User::class, 10)->create()->each(function($u){
            for($i = 0; $i < 100; $i++){
                $u->movements()->save(factory(Movement::class)->make());
            }
        });
    }
}
