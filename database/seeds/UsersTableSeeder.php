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
            'name'      => 'Administrador',
            'email'     => 'administrator@gmail.com',
            'password'  => bcrypt('admin'),
            'type'      => 'ADMIN'
        ]);
    }
}
