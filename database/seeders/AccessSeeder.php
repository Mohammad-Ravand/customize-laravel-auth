<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acceses = [
            [
                'name'=> 'show:role',
                'description'=> 'show roles model data',
            ],
            [
                'name'=> 'create:role',
                'description'=> 'create roles model data',
            ],
            [
                'name'=> 'update:role',
                'description'=> 'update roles model data',
            ],
            [
                'name'=> 'delete:role',
                'description'=> 'delete roles model data',
            ],
        ];

        $acceses = Access::insert($acceses);
    }
}
