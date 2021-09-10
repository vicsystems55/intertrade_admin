<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(UserTableSeeder::class);
        $this->call(AccountHeadSeeder::class);
        $this->call(AccountSubHeadSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(InventorySeeder::class);
        // $this->call(AccountMappingSeeder::class);

        
    }
}
