<?php

namespace App\Exports;

use App\Models\JenisCuti;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PermohonanDisetujuiExportALL implements FromView
{
    protected $year;
    protected $jenis_cuti;

    public function __construct($year, $jenis_cuti)
    {
        $this->year = $year;
        $this->jenis_cuti = $jenis_cuti;
    }

    public function view(): View
    {

        $months = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
        ];

        $jenis_cuti_nama = JenisCuti::where('id', $this->jenis_cuti)->select('jenis_cuti')->first();
        $jenis_cutis = JenisCuti::pluck('id');
        // dd($jenis_cutis);

        $results = [];
        $total_rentang_hari = [];

        // foreach ($jenis_cutis as $jenis_cuti) {
        //     $result = DB::table('users')
        //         ->select('users.nip', DB::raw('SUM(DATEDIFF(permohonan_cuti.tgl_akhir, permohonan_cuti.tgl_mulai)) AS rentang_hari'))
        //         ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        //         ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        //         ->leftJoin('units', 'users.unit_id', '=', 'units.id')
        //         ->where('permohonan_cuti.status', '=', 4)
        //         ->whereRaw('permohonan_cuti.jenis_cuti_id = ?', [$jenis_cuti])
        //         ->groupBy('users.nip')
        //         ->get();


        //         foreach ($result as $row) {
        //             $nip = $row->nip;
        //             $totalDays = $row->rentang_hari ?? 0;
    
        //             if (!isset($results[$nip])) {
        //                 $results[$nip] = [];
        //             }
    
                    
    
        //             $results[$nip][$jenis_cuti] = $totalDays;
        //         }
        // }
        foreach ($months as $month) {
            $result = DB::table('users')
                ->select('users.nip', DB::raw('SUM(DATEDIFF(permohonan_cuti.tgl_akhir, permohonan_cuti.tgl_mulai)) AS rentang_hari'))
                ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('permohonan_cuti.status', '=', 4)
                ->where('permohonan_cuti.jenis_cuti_id', $this->jenis_cuti)
                ->whereYear('permohonan_cuti.tgl_mulai', $this->year)
                ->whereRaw('MONTH(permohonan_cuti.tgl_mulai) = ?', [$month])
                ->groupBy('users.nip')
                ->get();

            foreach ($result as $row) {
                $nip = $row->nip;
                $totalDays = $row->rentang_hari ?? 0;

                if (!isset($results[$nip])) {
                    $results[$nip] = [];
                    $total_rentang_hari[$nip] = 0;
                }

                // Menghitung jumlah cuti bulan sebelumnya
                $previousMonth = $month - 1;
                $previousTotalDays = $results[$nip][$previousMonth] ?? 0;
                $currentTotalDays = $previousTotalDays + $totalDays;

                $results[$nip][$month] = $currentTotalDays;
                $total_rentang_hari[$nip] += $totalDays;
            }
        }
        // dd($results);




        return view('permohonancuti.export_excel_2', [
            'permohonan_disetujui' => User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('permohonan_cuti.status', 4)
                ->where('permohonan_cuti.jenis_cuti_id', $this->jenis_cuti)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->select('users.name', 'users.nip', 'users.jabatan', 'units.name_unit', 'hak_cuti.hak_cuti')
                ->groupBy('users.nip')
                ->get(),
            'jenis_cuti' => $jenis_cutis,
            'jenis_cuti_nama' => $jenis_cuti_nama,
            'results' => $results,
            'months' => $months,
            'total_rentang_hari' => $total_rentang_hari
        ]);
    }
}
