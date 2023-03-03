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
            'name'=> 'Direksi'
        ]);

        Unit::create([
            'name'=> 'SPI'
        ]);

        Unit::create([
            'name'=> 'P4MP'
        ]);

        Unit::create([
            'name'=> 'PPM'
        ]);


        Unit::create([
            'name'=> 'Teknik Informatika'
        ]);

        Unit::create([
            'name'=> 'Teknik Mesin'
        ]);

        Unit::create([
            'name'=> 'Teknik Elektronika'
        ]);
        
        Unit::create([
            'name'=> 'Teknik Pencemaran Pengendalian Lingkungan'
        ]);

        Unit::create([
            'name'=> 'D4 PPA'
        ]);

        Unit::create([
            'name'=> 'Umum'
        ]);

        Unit::create([
            'name'=> 'Akademik'
        ]);

        Unit::create([
            'name'=> 'Keuangan'
        ]);

        Unit::create([
            'name'=> 'Teknologi Informasi Komputer'
        ]);

        Unit::create([
            'name'=> 'Pemeliharaan'
        ]);

        Unit::create([
            'name'=> 'Bahasa'
        ]);

        Unit::create([
            'name'=> 'Perpustakaan'
        ]);

    }
}
