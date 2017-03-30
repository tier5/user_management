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

       	'first_name'=>'xxxx',
        'last_name'=>'xxxx',
        'user_name'=>'Super Admin',
       	'email'=>'admin@gmail.com',
       	'phone_number'=>'xxxx',
       	'address'=>'xxxx',
       	'city'=>'xxxx',
       	'state'=>'xxxx',
       	'zip'=>'xxxx',
       	'password'=>bcrypt('superadmin'),
       	'role'=>1,
       	'blocked_status'=>0
       	]);
    }
}
