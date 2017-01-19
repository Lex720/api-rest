<?php

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create([
            'name' => 'test'
        ]);

        Priority::create([
            'name' => 'test2'
        ]);

        Priority::create([
            'name' => 'test3'
        ]);
    }
}
