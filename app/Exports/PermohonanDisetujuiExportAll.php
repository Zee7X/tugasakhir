<?php

namespace App\Exports;

use DateTime;
use DateInterval;
use App\Models\User;
use App\Models\JenisCuti;
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

        $jenis_cuti_nama = JenisCuti::where('id', $this->jenis_cuti)->select('jenis_cuti')->first();
        $jenis_cutis = JenisCuti::pluck('id');
        // dd($jenis_cutis);

        $results = [];
        $total_rentang_hari = [];
        foreach ($months as $month) {
            $result = DB::table('users')
            ->select('users.nip', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir') // Include tgl_mulai and tgl_akhir in the SELECT statement
            ->join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 4)
            ->where('permohonan_cuti.jenis_cuti_id', $this->jenis_cuti)
            ->whereYear('permohonan_cuti.tgl_mulai', $this->year)
            ->whereRaw('MONTH(permohonan_cuti.tgl_mulai) = ?', [$month])
            ->groupBy('users.nip', 'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir') // Group by tgl_mulai and tgl_akhir
            ->get();

                foreach ($result as $row) {
                    $nip = $row->nip;
                    $weekdaysCount = $this->countWeekdays($row->tgl_mulai, $row->tgl_akhir) ?? 0; // Calculate weekdays count for each row
                
                    if (!isset($results[$nip])) {
                        $results[$nip] = [];
                        $total_rentang_hari[$nip] = 0;
                    }
                
                    // Calculate the total weekdays for the current month
                    $currentTotalDays = $results[$nip][$month] ?? 0; // Get the existing value or 0 if not set
                    $currentTotalDays += $weekdaysCount;
                
                    // Calculate the total weekdays for the current user across all months
                    $total_rentang_hari[$nip] += $weekdaysCount;
                
                    // Update the values in the arrays
                    $results[$nip][$month] = $currentTotalDays;
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