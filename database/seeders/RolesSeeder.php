<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use illuminate\Support\Facades\Hash;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Backend Developer','FrontEnd Developer', 'Admin', 'user', 'programmer'];

        foreach($roles as $role)
        {
            DB::table('roles')->insert([
                'name' => $role
            ]);
        }
    }
}
