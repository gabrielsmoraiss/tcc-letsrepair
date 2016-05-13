<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'gabrielsmoraiss@gmail.com',
            'name' => 'Gabriel Silva de Morais',
            'password' => bcrypt('120909'),
            'type' => 'ADMINISTRATOR'
        ]);
    }
}
