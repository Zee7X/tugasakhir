<?php

namespace Database\Seeders;

use App\Models\JenisCuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Bersalin'
        ]);

        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Sakit'
        ]);

        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Besar'
        ]);

        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Tahunan'
        ]);

        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Ibadah Keagamaan'
        ]);

        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Karena Alasan Penting'
        ]);
        JenisCuti::create([
            'jenis_cuti'=> 'Cuti Diluar Tanggungan'
        ]);
        
    }
}
