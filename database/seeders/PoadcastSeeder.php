<?php

namespace Database\Seeders;

use App\Models\Poadcast;
use Illuminate\Database\Seeder;

class PoadcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poadcast::factory()->count(20)->create();
    }
}
