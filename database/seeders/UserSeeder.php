<?php

namespace Database\Seeders;

use App\Models\HakCuti;
use App\Models\User;
use Carbon\Carbon;
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
            'name' => 'Dhiya Udin Adha Suhadi',
            'email'=> 'udin@gmail.com',
            'password'=> Hash::make('udin'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 1,
            'jabatan'=> 'Dosen',
            'unit_id'=> 1,
        ]);
        HakCuti::create([
            'user_id' => 1,
            'hak_cuti' => 12,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'nip'=> '200302096',
            'name' => 'Muhamad Aldi',
            'email'=> 'aldot@gmail.com',
            'password'=> Hash::make('aldot'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 2,
            'jabatan'=> 'Kepala Bagian',
            'unit_id'=> 2,
        ]);

        HakCuti::create([
            'user_id' => 2,
            'hak_cuti' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'nip'=> '200102015',
            'name' => 'Imas Nurdianto',
            'email'=> 'imas@gmail.com',
            'password'=> Hash::make('imas'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 3,
            'jabatan'=> 'Wakil Direktur II',
            'unit_id'=> 3,
        ]);
        HakCuti::create([
            'user_id' => 3,
            'hak_cuti' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
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
        HakCuti::create([
            'user_id' => 4,
            'hak_cuti' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
