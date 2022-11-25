<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nip'=> '200302095',
            'name' => 'Udin',
            'email'=> 'udin@gmail.com',
            'password'=> Hash::make('udin'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 1,
            'jabatan'=> 'Dosen',
            'unit_id'=> 1,
            'hak_cuti' => 12,
        ]);
        User::create([
            'nip'=> '200302096',
            'name' => 'Aldot',
            'email'=> 'aldot@gmail.com',
            'password'=> Hash::make('aldot'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 2,
            'jabatan'=> 'Kepala Bagian',
            'unit_id'=> 2,
        ]);
        User::create([
            'nip'=> '200302097',
            'name' => 'Imas Anjay Mabar',
            'email'=> 'imas@gmail.com',
            'password'=> Hash::make('imas'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 3,
            'jabatan'=> 'Wakil Direktur II',
            'unit_id'=> 3,
        ]);
        User::create([
            'nip'=> '200302094',
            'name' => 'Rizick Fimelyan Sabillah',
            'email'=> 'rizickknotfest@gmail.com',
            'password'=> Hash::make('test'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 4,
            'jabatan'=> 'Bagian Kepegawaian',
            'unit_id'=> 4,
        ]);
    }
}
