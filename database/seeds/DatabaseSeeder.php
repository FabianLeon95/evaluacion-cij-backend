<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = new User([
            'name' => 'Admin',
            'email' => 'evaluacion.cij@gmail.com',
            'password' => bcrypt('admin.cij1219'),
        ]);
        $user->save();
    }
}
