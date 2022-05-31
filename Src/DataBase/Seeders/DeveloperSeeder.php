<?php

namespace Src\Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Models\Dev;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $devList = [
                [
                    'name' => "Dev1",
                    'level' => 1
                ],
                [
                    'name' => "Dev2",
                    'level' => 2
                ],
                [
                    'name' => "Dev3",
                    'level' => 3
                ],
                [
                    'name' => "Dev4",
                    'level' => 4
                ],
                [
                    'name' => "Dev5",
                    'level' => 5
                ],
            ];

            foreach ($devList as  $dev) {
                Dev::updateOrCreate ([
                    'name' => $dev['name'],
                    'level' => $dev['level'],
                ]);
            }

    }
}
