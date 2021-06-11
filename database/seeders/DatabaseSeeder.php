<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\CardAttribute;
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
        Card::factory()
            ->count(50)
            ->hasAttributes(1)
            ->create();

    }
}
