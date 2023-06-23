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
        // info status
        // 0 - Dibatalkan
        // 1 - Pending Kepala unit
        // 2 - Pending Wakil Direktur
        // 3 - Pending Direktur
        // 4 - Disetujui
        // 5 - Ditolak

        PermohonanModel::create([
            'user_id' => 1,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-13',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' =>  1,
        ]);
        PermohonanModel::create([
            'user_id' => 3,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Tahunan',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-14',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 2,
        ]);
        PermohonanModel::create([
            'user_id' => 2,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Ibadah',
            'tgl_mulai' => '2022-12-10',
            'tgl_akhir' => '2022-12-11',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 4,
        ]);
        PermohonanModel::create([
            'user_id' => 4,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-11-10',
            'tgl_akhir' => '2022-11-12',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 4,
        ]);
        PermohonanModel::create([
            'user_id' => 1,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 5
        ]);
        PermohonanModel::create([
            'user_id' => 3,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 1,
        ]);
        PermohonanModel::create([
            'user_id' => 2,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 2,
        ]);
        PermohonanModel::create([
            'user_id' => 4,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 1,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 4,
        ]);
        PermohonanModel::create([
            'user_id' => 3,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 5,
        ]);
        PermohonanModel::create([
            'user_id' => 2,
            'jenis_cuti_id' => 5,
            'alasan_cuti' => 'Cuti Ibadah Keagamaan',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 4,
            'jenis_cuti_id' => 6,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 5,
        ]);
        PermohonanModel::create([
            'user_id' => 1,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 3,
            'jenis_cuti_id' => 2,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 2,
            'jenis_cuti_id' => 3,
            'alasan_cuti' => 'Cuti Ibadah',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 4,
            'jenis_cuti_id' => 4,
            'alasan_cuti' => 'Cuti Melahirkan',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 5,
        ]);
        PermohonanModel::create([
            'user_id' => 1,
            'jenis_cuti_id' => 5,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 3,
            'jenis_cuti_id' => 6,
            'alasan_cuti' => 'Mudik',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 0,
        ]);
        PermohonanModel::create([
            'user_id' => 2,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Tahunan',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 0,
        ]);
        PermohonanModel::create([
            'user_id' => 4,
            'jenis_cuti_id' => 2,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 5,
        ]);
        PermohonanModel::create([
            'user_id' => 1,
            'jenis_cuti_id' => 3,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 3,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 2,
            'jenis_cuti_id' => 4,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 3,
        ]);
        PermohonanModel::create([
            'user_id' => 4,
            'jenis_cuti_id' => 5,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl.Buntu',
            'status' => 5,
        ]);

        PermohonanModel::create([
            'user_id' => 5,
            'jenis_cuti_id' => 6,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl. Mana',
            'status' => 1,
        ]);
        PermohonanModel::create([
            'user_id' => 5,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Cuti Alasan Penting',
            'tgl_mulai' => '2022-12-12',
            'tgl_akhir' => '2022-12-22',
            'alamat_cuti'=> 'Jl. Mana',
            'status' => 5,
        ]);
        PermohonanModel::create([
            'user_id' => 5,
            'jenis_cuti_id' => 1,
            'alasan_cuti' => 'Libur Akhir Tahun',
            'tgl_mulai' => '2022-12-13',
            'tgl_akhir' => '2022-12-23',
            'alamat_cuti'=> 'Jl. Mana',
            'status' => 5,
        ]);
    }
}
