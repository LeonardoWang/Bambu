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
          'tel' => '1300013000',
          'password' => bcrypt('secret'),
          'is_admin' => True
      ]);
    }
}
