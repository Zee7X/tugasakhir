<?php

namespace App\Exports;

use DateTime;
use DateInterval;
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

    // Helper function to count weekdays
    function countWeekdays($startDate, $endDate)
    {
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        $currentDate = clone $startDate;
        $count = 0;

        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->format('N');

            // Hanya menghitung hari Senin - Jumat (kode 1 hingga 5)
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                $count++;
            }

            $currentDate->add(new DateInterval('P1D'));
        }

        return $count;
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
            ->select('users.nip', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir') // Include tgl_mulai and tgl_akhir in the SELECT statement
            ->addSelect(DB::raw('SUM(DATEDIFF(permohonan_cuti.tgl_akhir, permohonan_cuti.tgl_mulai)) AS rentang_hari'))
            ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 4)
            ->whereYear('permohonan_cuti.tgl_mulai', $this->year)
            ->whereRaw('MONTH(permohonan_cuti.tgl_mulai) = ?', [$month])
            ->groupBy('users.nip', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir') // Group by tgl_mulai and tgl_akhir
            ->get();

        foreach ($result as $row) {
            $nip = $row->nip;
            $totalDays = $row->rentang_hari ?? 0;
            $weekdaysCount = $this->countWeekdays($row->tgl_mulai, $row->tgl_akhir); // Calculate weekdays count for each row

            if (!isset($results[$nip])) {
                $results[$nip] = [];
                $total_rentang_hari[$nip] = 0;
            }

            // Calculate the total days and weekdays for the current month
            $results[$nip][$month] = $weekdaysCount;
            $total_rentang_hari[$nip] += $weekdaysCount;
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

}
