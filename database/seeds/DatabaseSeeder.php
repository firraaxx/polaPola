<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Model;
use App\Traits\HasCompositePrimaryKey;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);        
    }
}
