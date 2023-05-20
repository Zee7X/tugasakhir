<?php

namespace Database\Seeders;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Unit::create([
            'name_unit'=> 'Direksi'
        ]);

        Unit::create([
            'name_unit'=> 'P4MP'
        ]);

        Unit::create([
            'name_unit'=> 'PPM'
        ]);

        Unit::create([
            'name_unit'=> 'Teknik Informatika'
        ]);


        Unit::create([
            'name_unit'=> 'Teknik Mesin'
        ]);

        Unit::create([
            'name_unit'=> 'Teknik Elektronika'
        ]);

        Unit::create([
            'name_unit'=> 'Teknik Pencemaran Pengendalian Lingkungan'
        ]);
        
        Unit::create([
            'name_unit'=> 'Pengembangan Produk Agroindustri'
        ]);

        Unit::create([
            'name_unit'=> 'Akuntansi Lembaga Keuangan Syariah'
        ]);

        Unit::create([
            'name_unit'=> 'Umum'
        ]);

        Unit::create([
            'name_unit'=> 'Akademik'
        ]);

        Unit::create([
            'name_unit'=> 'Keuangan'
        ]);

        Unit::create([
            'name_unit'=> 'Teknologi Informasi Komputer'
        ]);

        Unit::create([
            'name_unit'=> 'Pemeliharaan'
        ]);

        Unit::create([
            'name_unit'=> 'Bahasa'
        ]);

        Unit::create([
            'name_unit'=> 'Perpustakaan'
        ]);

    }
}
