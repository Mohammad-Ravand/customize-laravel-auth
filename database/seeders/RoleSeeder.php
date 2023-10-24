<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name'=> 'superAdmin',
                'description'=> 'SuperAdmin all website'
            ],
            [
                'name'=> 'admin',
                'description'=> 'admin all website'
            ],
            [
                'name'=> 'writer',
                'description'=> 'writer all website'
            ],
            [
                'name'=> 'programmer',
                'description'=> 'programmer all website'
            ],
            [
                'name'=> 'marketer',
                'description'=> 'marketer all website'
            ],
        ];

        $roles = Role::insert($roles);
    }
}
