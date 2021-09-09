<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insertOrIgnore([

            [
                'name' => 'Eghosa Ogedegbe',
                'email' => 'eghosa@intertradeltd.biz',
                'password' => Hash::make('Intertrade_admin1@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'admin',
            ],

            [
                'name' => 'Ukiaghe Ogedegbe',
                'email' => 'ukiaghe@intertradeltd.biz',
                'password' => Hash::make('Intertrade_admin2@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'admin',
            ],

            [
                'name' => 'Ejiro Ogedegbe',
                'email' => 'ejiro@intertradeltd.biz',
                'password' => Hash::make('Intertrade_admin3@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'admin',
            ],

            [
                'name' => 'Victor Asuquo',
                'email' => 'victor@intertradeltd.biz',
                'password' => Hash::make('Intertrade_admin4@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'superadmin',
            ],

            [
                'name' => 'Kingsley Ogedegbe',
                'email' => 'udegbekingsley@gmail.com',
                'password' => Hash::make('Intertrade_admin5@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'superadmin',
            ],

            [
                'name' => 'Isah Onu Ibrahim',
                'email' => 'isa@intertradeltd.biz',
                'password' => Hash::make('ibrahim@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'driver',
            ],

            [
                'name' => 'Ernest Igiri',
                'email' => 'ernest@intertradeltd.biz',
                'password' => Hash::make('ernest@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'driver',
            ],

            [
                'name' => 'Femi Olasunkami',
                'email' => 'olasunkami@intertradeltd.biz',
                'password' => Hash::make('olasunkami@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'driver',
            ],


            [
                'name' => 'Peter Tankpinou',
                'email' => 'peter@intertradeltd.biz',
                'password' => Hash::make('peter@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'technician',
            ],

            [
                'name' => 'Ernest Igiri',
                'email' => 'ernest2@intertradeltd.biz',
                'password' => Hash::make('ernest@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'technician',
            ],

            [
                'name' => 'Margaret',
                'email' => 'margaret@intertradeltd.biz',
                'password' => Hash::make('margaret@2021'),
                'user_code' => 'ITL'.rand(11000,99990),
                'role' => 'secretary',
            ],
        ]);
    }
}
