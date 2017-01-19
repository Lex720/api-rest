<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'id_user'     => '1',
            'id_priority' => '1',
            'title'       => 'test',
            'description' => 'test',
            'due_date'    => '2017/01/18',
        ]);

        Task::create([
            'id_user'     => '1',
            'id_priority' => '2',
            'title'       => 'test2',
            'description' => 'test2',
            'due_date'    => '2017/01/18',
        ]);

        Task::create([
            'id_user'     => '1',
            'id_priority' => '3',
            'title'       => 'test3',
            'description' => 'test3',
            'due_date'    => '2017/01/18',
        ]);
    }
}
