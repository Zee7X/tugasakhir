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
            'name'=> 'Teknik Informatika'
        ]);

        Unit::create([
            'name'=> 'Teknik Mesin'
        ]);

        Unit::create([
            'name'=> 'Teknik Elektro'
        ]);
        
        Unit::create([
            'name'=> 'Teknik Listrik'
        ]);
    }
}
