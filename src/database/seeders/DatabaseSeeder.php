<?php

namespace Database\Seeders;

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
        $this->call(CategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(ChannelContactSeeder::class);
    }
}
