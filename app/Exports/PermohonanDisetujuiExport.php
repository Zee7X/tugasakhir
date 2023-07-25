<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PermohonanDisetujuiExport implements FromView
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function view(): View
    {
        $months = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
        ];

        $results = [];
        $total_rentang_hari = [];

        foreach ($months as $month) {
            $result = DB::table('users')
                ->select('users.nip', DB::raw('SUM(DATEDIFF(permohonan_cuti.tgl_akhir, permohonan_cuti.tgl_mulai)) AS rentang_hari'))
                ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('permohonan_cuti.status', '=', 4)
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
    
                    // Custom function to count weekdays (Monday to Friday)
                    $currentTotalDays = $this->countWeekdays($month, $totalDays);
    
                    $results[$nip][$month] = $currentTotalDays+1;
                    $total_rentang_hari[$nip] += $currentTotalDays+1;
                }
        }
        return view('permohonancuti.export_excel', [
            'permohonan_disetujui' => User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('permohonan_cuti.jenis_cuti_id', 4)
                ->whereYear('permohonan_cuti.tgl_mulai', $this->year)
                ->where('permohonan_cuti.status', 4)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->select('users.name', 'users.nip', 'users.jabatan', 'units.name_unit', 'hak_cuti.hak_cuti')
                ->groupBy('users.nip')
                ->get(),
            'results' => $results,
            'months' => $months,
            'total_rentang_hari' => $total_rentang_hari
        ]);
    }

    private function countWeekdays($month, $totalDays)
    {
        $year = $this->year;

        $weekdays = 0;
        $day = 1;
        while ($day <= $totalDays) {
            $dateString = "$year-$month-$day";
            $dayOfWeek = date('N', strtotime($dateString));

            // Check if the day is Monday to Friday (1 to 5)
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                $weekdays++;
            }

            $day++;
        }

        return $weekdays;
    }
}