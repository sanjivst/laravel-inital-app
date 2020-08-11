<?php

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
        $scope = Access\User\Scope::create([
            'name' => 'Admin',
            'description' => 'Admin'
        ]);
        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('P@ssword'),
            'scope_id' => $scope->id
        ]);
       
    }
}
