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
          'name' => 'admin',
          'email' => 'wtf@wtf.com',
          'password' => bcrypt('secret'),
          'is_admin' => True
      ]);
    }
}
