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
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(LogoTableSeeder::class);
        $this->call(SeoTableSeeder::class);
        $this->call(OtherContactTableSeeder::class);
    }
}
