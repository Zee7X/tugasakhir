<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=> 'Pegawai'
        ]);

        Role::create([
            'name'=> 'Assesor1'
        ]);

        Role::create([
            'name'=> 'Assesor2'
        ]);
        
        Role::create([
            'name'=> 'Admin'
        ]);
    }
}
