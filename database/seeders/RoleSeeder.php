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
            'name'=> 'Kepala Unit'
        ]);

        Role::create([
            'name'=> 'Wakil Direktur 2'
        ]);

        Role::create([
            'name'=> 'Direktur'
        ]);

        Role::create([
            'name'=> 'Admin'
        ]);
    }
}
