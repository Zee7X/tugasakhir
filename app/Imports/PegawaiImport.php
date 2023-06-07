<?php

namespace App\Imports;

use App\Models\HakCuti;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class PegawaiImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $key => $row) {
            if ($key >= 0 && $key <= 500) {
                $user = User::firstOrCreate([
                    'nip' => $row[1]
                ],[
                    'name' => $row[2],
                    'jenis_kelamin' => $row[5],
                    'jabatan' => $row[7],
                    'email' => $row[3],
                    'password' => Hash::make('12345678'),
                    'role_id' => $row[6],
                    'unit_id' => $row[8],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                HakCuti::create([
                    'user_id' => $user->id,
                    'hak_cuti' => 12,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
