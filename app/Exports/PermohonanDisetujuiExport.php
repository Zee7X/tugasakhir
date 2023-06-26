<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PermohonanDisetujuiExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

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

        return view('permohonancuti.export_excel', [
            'permohonan_disetujui' => User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
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
}
