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
            'name'=> 'pegawai'
        ]);

        Role::create([
            'name'=> 'kepalabagian'
        ]);

        Role::create([
            'name'=> 'wakildirektur2'
        ]);
        
        Role::create([
            'name'=> 'bagiankepegawaian'
        ]);
    }
}
