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
            'nip'=> '200302094',
            'name' => 'Rizick Fimelyan Sabillah',
            'email'=> 'rizick@gmail.com',
            'password'=> Hash::make('test'),
            'jenis_kelamin'=> 'Laki-Laki',
            'role_id'=> 4,
            'jabatan'=> 'Bagian Kepegawaian',
            'unit_id'=> 4,
        ]);
        HakCuti::create([
            'user_id' => 1,
            'hak_cuti' => 12,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

       

        
    }
}
