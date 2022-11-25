<?php

namespace Database\Seeders;
use App\Models\PermohonanModel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermohonanModel::create([
            'user_id' => 1,
            'alasan_cuti' => 'libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 'Disetujui',
        ]);
    }
}
