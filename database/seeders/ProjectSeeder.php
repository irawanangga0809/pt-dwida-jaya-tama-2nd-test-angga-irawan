<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class  ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory(5)->create([
            'user_id'=> '1',
        ]);
        Project::factory(5)->create([
            'user_id'=> '2',
        ]);
    }
}
