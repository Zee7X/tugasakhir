<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermohonanDisetujuiExport;
use App\Exports\PermohonanDisetujuiExportAll;
use App\Models\JenisCuti;

class RiwayatPermohonanController extends Controller
{
    //Riwayat Cuti Wadir, Bagian Kepegawaian, Kepala Unit
    public function riwayat_permohonan()
    {
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', auth()->user()->id)->pluck('hak_cuti');
        // if (auth()->user()->role_id == 2 || auth()->user()->role_id == 5 || auth()->user()->role_id == 3) {
        //     $riwayat = User::join(
        //         'permohonan_cuti',
        //         'users.id',
        //         '=',
        //         'permohonan_cuti.user_id'
        //     )
        //         ->leftJoin('units', 'users.unit_id', '=', 'units.id')
        //         ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
        //         ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
        //         ->orderBy('permohonan_cuti.updated_at', 'DESC')
        //         ->select(
        //             'permohonan_cuti.id',
        //             'users.name',
        //             'users.jabatan',
        //             'units.name_unit',
        //             'permohonan_cuti.user_id',
        //             'permohonan_cuti.tgl_mulai',
        //             'jenis_cutis.jenis_cuti',
        //             'permohonan_cuti.alasan_cuti',
        //             'permohonan_cuti.tgl_akhir',
        //             'permohonan_cuti.alamat_cuti',
        //             'permohonan_cuti.status'
        //         )
        //         ->get();
        // }

        if (auth()->user()->role_id == 4) {
            $riwayat = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->where('permohonan_cuti.status', '=', '4')
                ->select(
                    'permohonan_cuti.id',
                    'users.name',
                    'users.jabatan',
                    'units.name_unit',
                    'permohonan_cuti.user_id',
                    'permohonan_cuti.tgl_mulai',
                    'jenis_cutis.jenis_cuti',
                    'permohonan_cuti.alasan_cuti',
                    'permohonan_cuti.tgl_akhir',
                    'permohonan_cuti.alamat_cuti',
                    'permohonan_cuti.status'
                )
                ->get();
        }
        return view('permohonanCuti.riwayat', compact('riwayat', 'sisacuti'));
    }

    public function permohonanKu(){
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', auth()->user()->id)->pluck('hak_cuti');
            $riwayat = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
                ->orderBy('permohonan_cuti.status', 'ASC')
                ->select(
                    'permohonan_cuti.id',
                    'users.name',
                    'users.jabatan',
                    'units.name_unit',
                    'permohonan_cuti.user_id',
                    'permohonan_cuti.tgl_mulai',
                    'jenis_cutis.jenis_cuti',
                    'permohonan_cuti.alasan_cuti',
                    'permohonan_cuti.tgl_akhir',
                    'permohonan_cuti.alamat_cuti',
                    'permohonan_cuti.status'
                )
                ->get();
        return view('permohonanCuti.tambah', compact('riwayat', 'sisacuti'));
    }
    //Function View Acc Cuti
    public function permohonan_disetujui()
    {
        $jenis_cuti = JenisCuti::whereNotIn('id', [4])->get();
        //View Acc Bagian Kepegawaian & Wakil Direktur II
        if (auth()->user()->role_id == 4 || auth()->user()->role_id == 3 || auth()->user()->role_id == 5) {
            $permohonan_disetujui = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', '4')
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //View Acc Pegawai
        if (auth()->user()->role_id == 1) {
            $permohonan_disetujui = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', '4')
                ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //View Acc Kepala Unit
        if (auth()->user()->role_id == 2) {
            $permohonan_disetujui = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('permohonan_cuti.status', '=', '4')
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }
        return view(
            'permohonancuti.disetujui',
            compact('permohonan_disetujui', 'jenis_cuti')
        );
    }

    //Function View Reject Cuti
    public function permohonan_ditolak()
    {
        //View Reject Bagian Kepegawaian & Direktur & Wakill Direktur II
        if (auth()->user()->role_id == 4 || auth()->user()->role_id == 3 || auth()->user()->role_id == 5) {
            $permohonan_ditolak = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', 5)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //View Reject Pegawai
        if (auth()->user()->role_id == 1) {
            $permohonan_ditolak = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', 5)
                ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //View Reject Kepala Unit
        if (auth()->user()->role_id == 2) {
            $permohonan_ditolak = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('permohonan_cuti.status', '=', 5)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }
        return view('permohonancuti.ditolak', compact('permohonan_ditolak'));
    }

    //View Cuti Dibatalkan
    public function permohonan_dibatalkan()
    {
        //Kepala Bagian
        if (auth()->user()->role_id == 4 || auth()->user()->role_id == 3 || auth()->user()->role_id == 5) {
            $permohonan_dibatalkan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', 0)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //Pegawai
        if (auth()->user()->role_id == 1) {
            $permohonan_dibatalkan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', 0)
                ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //Kepala Unit
        if (auth()->user()->role_id == 2) {
            $permohonan_dibatalkan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('permohonan_cuti.status', '=', 0)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }
        return view('permohonancuti.dibatalkan', compact('permohonan_dibatalkan'));
    }

    //export excel
    public function export_excel(Request $request)
{
    $year = $request->tahun;
    return Excel::download(new PermohonanDisetujuiExport($year), 'Laporan Cuti Tahun ' . $year . '.xlsx');
}
    public function export_excel_2(Request $request)
    {
        $year = $request->tahun;
        $jenis_cuti = $request->jenis;
        $nama_cuti = JenisCuti::where('id', $jenis_cuti)->select('jenis_cuti')->first();
        $nama_file = 'Laporan '. $nama_cuti->jenis_cuti .' '. $year .'.xlsx';
        return Excel::download(new PermohonanDisetujuiExportAll($year, $jenis_cuti), $nama_file);
    }
}
