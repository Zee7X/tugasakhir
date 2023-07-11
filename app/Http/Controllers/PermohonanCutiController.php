<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Mail\sicute;
use App\Models\User;
use App\Models\HakCuti;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use App\Models\PermohonanModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PermohonanCutiController extends Controller
{

    //Tambah Permohonan Cuti
    public function tambahPermohonan(Request $request)
    {
        // $kepala_unit = User::where('unit_id', Auth::user()->unit_id)->where('role_id', 2)->first();
        // dd($kepala_unit->email);
        $id = Auth()->user()->id;
        $data = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', $id)
            ->get();
        $sisaCuti = $data[0]->hak_cuti;
        $tglMulai = date_create($request->tgl_mulai);
        $tglAkhir = date_create($request->tgl_akhir);
        $durasi = date_diff($tglMulai, $tglAkhir);
        $jumlahCuti = $sisaCuti - $durasi->days;
        if ($request->alasan_cuti == 'Cuti Tahunan' && $jumlahCuti < 0) {
            return redirect()
                ->route('permohonan')
                ->with(['error' => 'Maaf sisa cuti anda tidak mencukupi']);
        } else {
            if ($request->alasan_cuti == 'Cuti Tahunan' && $durasi->days <= 0) {
                return redirect()
                    ->route('permohonan')
                    ->with([
                        'error' => 'Silahkan periksa kembali tanggal cuti',
                    ]);
            } else {
                $validasiData = Validator::make($request->all(), [
                    'alasan_cuti_lainnya' => 'required',
                    'alasan_cuti' => 'required',
                    'tgl_mulai' => 'required',
                    'tgl_akhir' => 'required',
                    'alamat_cuti' => 'required|max:255',
                ]);
                if ($validasiData->fails()) {
                    return back()
                        ->withInput()
                        ->with(['error' => 'Silahkan periksa alasan cuti!']);
                } else {
                    //Tambah Permohonan Pegawai & Bagian Kepegawaian
                    if (Auth()->user()->role_id == 1 || Auth()->user()->role_id == 4) {
                        // if ($request->alasan_cuti_lainnya != null) {
                        //     $alesan = $request->alasan_cuti_lainnya;
                        // } else {
                        //     $alesan = $request->alasan_cuti;
                        // }

                        $name_cuti = $request->alasan_cuti;
                        $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                        // dd($id_cuti);

                        $pengajuan_permohonan = PermohonanModel::insert([
                            'user_id' =>  Auth::id(),
                            'alasan_cuti' => $request->alasan_cuti_lainnya,
                            'jenis_cuti_id' => $id_cuti,
                            'tgl_mulai' => $request->tgl_mulai,
                            'tgl_akhir' => $request->tgl_akhir,
                            'alamat_cuti' => $request->alamat_cuti,
                            'status' => 1,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);

                        //pengurangan sisa cuti hanya untuk tahunan
                        if ($request->alasan_cuti == 'Cuti Tahunan') {

                            $hak_cuti = [
                                'hak_cuti' => $jumlahCuti,
                            ];
                            HakCuti::whereId($id)->update($hak_cuti);
                        }


                        //email
                        if ($request->alasan_cuti == 'Cuti Tahunan') {
                            $mailData = [
                                'title' => 'Mail from SICUTE',
                                'body' => 'Assalamualaikum',
                                'name' => Auth::user()->name,
                                'sisa_cuti' => $jumlahCuti,
                                'jenis_cuti' => $request->alasan_cuti,
                                'alasan_cuti' => $request->alasan_cuti_lainnya,
                                'tgl_mulai' => $request->tgl_mulai,
                                'tgl_akhir' => $request->tgl_akhir,
                                'alamat_cuti' => $request->alamat_cuti,
                            ];
                        } else {
                            $mailData = [
                                'title' => 'Mail from SICUTE',
                                'body' => 'Assalamualaikum',
                                'name' => Auth::user()->name,
                                'sisa_cuti' => $sisaCuti,
                                'jenis_cuti' => $request->alasan_cuti,
                                'alasan_cuti' => $request->alasan_cuti_lainnya,
                                'tgl_mulai' => $request->tgl_mulai,
                                'tgl_akhir' => $request->tgl_akhir,
                                'alamat_cuti' => $request->alamat_cuti,
                            ];
                        }

                        // dd($mailData);
                        //mail to kepala unit
                        $cekemail = PermohonanModel::all()->first();
                        // dd($cekemail->status == 1);
                        // if ($cekemail->status == 1) {
                            $kepala_unit = User::where('unit_id', Auth::user()->unit_id)->where('role_id', 2)->get();
                            foreach ($kepala_unit as $p) {

                                Mail::to($p->email)->send(new sicute($mailData));
                            }
                        // }





                        return redirect()->route('permohonan')
                            ->with(['success' => 'Berhasil Mengajukan Permohonan Cuti',], compact('data'));
                    }
                    //Tambah Permohonan Kepala Unit
                    elseif (Auth()->user()->role_id == 2) {
                        // if ($request->alasan_cuti_lainnya != null) {
                        //     $alesan = $request->alasan_cuti_lainnya;
                        // } else {
                        //     $alesan = $request->alasan_cuti;
                        // }

                        $name_cuti = $request->alasan_cuti;
                        $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                        PermohonanModel::insert([
                            'user_id' => Auth::id(),
                            'alasan_cuti' => $request->alasan_cuti_lainnya,
                            'jenis_cuti_id' => $id_cuti,
                            'tgl_mulai' => $request->tgl_mulai,
                            'tgl_akhir' => $request->tgl_akhir,
                            'alamat_cuti' => $request->alamat_cuti,
                            'status' => 2,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        if ($request->alasan_cuti == 'Cuti Tahunan') {

                            $hak_cuti = [
                                'hak_cuti' => $jumlahCuti,
                            ];
                            HakCuti::whereId($id)->update($hak_cuti);
                        }



                        //email
                        if ($request->alasan_cuti == 'Cuti Tahunan') {
                            $mailData = [
                                'title' => 'Mail from SICUTE',
                                'body' => 'Assalamualaikum',
                                'name' => Auth::user()->name,
                                'sisa_cuti' => $jumlahCuti,
                                'jenis_cuti' => $request->alasan_cuti,
                                'alasan_cuti' => $request->alasan_cuti_lainnya,
                                'tgl_mulai' => $request->tgl_mulai,
                                'tgl_akhir' => $request->tgl_akhir,
                                'alamat_cuti' => $request->alamat_cuti,
                            ];
                        } else {
                            $mailData = [
                                'title' => 'Mail from SICUTE',
                                'body' => 'Assalamualaikum',
                                'name' => Auth::user()->name,
                                'sisa_cuti' => $sisaCuti,
                                'jenis_cuti' => $request->alasan_cuti,
                                'alasan_cuti' => $request->alasan_cuti_lainnya,
                                'tgl_mulai' => $request->tgl_mulai,
                                'tgl_akhir' => $request->tgl_akhir,
                                'alamat_cuti' => $request->alamat_cuti,
                            ];
                        }

                        // dd($mailData);

                        $cekemail = PermohonanModel::latest()->first();
                        // dd($cekemail->status == 2);
                        // if ($cekemail->status == 2) {
                            $wadir = User::where('role_id', 3)->get();
                            foreach ($wadir as $p) {

                                Mail::to($p->email)->send(new sicute($mailData));
                            }
                        // }





                        return redirect()->route('riwayat.permohonan')
                            ->with(['success' => 'Berhasil Mengajukan Permohonan Cuti',]);
                    }
                    //Tambah Permohonan Wadir
                    elseif (Auth()->user()->role_id == 3) {
                        // if ($request->alasan_cuti_lainnya != null) {
                        //     $alesan = $request->alasan_cuti_lainnya;
                        // } else {
                        //     $alesan = $request->alasan_cuti;
                        // }

                        $name_cuti = $request->alasan_cuti;
                        $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                        PermohonanModel::insert([
                            'user_id' => Auth::id(),
                            'alasan_cuti' => $request->alasan_cuti_lainnya,
                            'jenis_cuti_id' => $id_cuti,
                            'tgl_mulai' => $request->tgl_mulai,
                            'tgl_akhir' => $request->tgl_akhir,
                            'alamat_cuti' => $request->alamat_cuti,
                            'status' => 3,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        if ($request->alasan_cuti == 'Cuti Tahunan') {

                            $hak_cuti = [
                                'hak_cuti' => $jumlahCuti,
                            ];
                            HakCuti::whereId($id)->update($hak_cuti);
                        }



                        //email
                        if ($request->alasan_cuti == 'Cuti Tahunan') {
                            $mailData = [
                                'title' => 'Mail from SICUTE',
                                'body' => 'Assalamualaikum',
                                'name' => Auth::user()->name,
                                'sisa_cuti' => $jumlahCuti,
                                'jenis_cuti' => $request->alasan_cuti,
                                'alasan_cuti' => $request->alasan_cuti_lainnya,
                                'tgl_mulai' => $request->tgl_mulai,
                                'tgl_akhir' => $request->tgl_akhir,
                                'alamat_cuti' => $request->alamat_cuti,
                            ];
                        } else {
                            $mailData = [
                                'title' => 'Mail from SICUTE',
                                'body' => 'Assalamualaikum',
                                'name' => Auth::user()->name,
                                'sisa_cuti' => $sisaCuti,
                                'jenis_cuti' => $request->alasan_cuti,
                                'alasan_cuti' => $request->alasan_cuti_lainnya,
                                'tgl_mulai' => $request->tgl_mulai,
                                'tgl_akhir' => $request->tgl_akhir,
                                'alamat_cuti' => $request->alamat_cuti,
                            ];
                        }


                        // dd($mailData);

                        $cekemail = PermohonanModel::latest()->first();
                        // dd($cekemail->status == 3);
                        // if ($cekemail->status == 3) {
                            $direktur = User::where('role_id', 5)->get();
                            foreach ($direktur as $p) {

                                Mail::to($p->email)->send(new sicute($mailData));
                            }
                        // }





                        return redirect()->route('riwayat.permohonan')
                            ->with(['success' => 'Berhasil Mengajukan Permohonan Cuti',]);
                    }
                }
            }
        }
    }


    //Edit Permohonan
    public function editPermohonan(Request $request, $id_permohonan)
    {
        $permohonan = PermohonanModel::findorFail($id_permohonan);
        $id = Auth()->user()->id;
        $data = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', $id)
            ->get();
        $sisaCuti = $data[0]->hak_cuti;
        $tglMulai = date_create($request->tgl_mulai);
        $tglAkhir = date_create($request->tgl_akhir);
        $durasi = date_diff($tglMulai, $tglAkhir);
        $requ_days = $durasi->days;

        $a = date_create($permohonan->tgl_mulai);
        $b = date_create($permohonan->tgl_akhir);
        $data_db = date_diff($a, $b);
        $data_days = $data_db->days;


        // dd($durasi->days);
        // dd($requ_days);
        // dd($sisaCuti - $requ_days);

        if ($permohonan->jenis_cuti_id == 4) {
            if ($request->alasan_cuti != 'Cuti Tahunan'){
                // semua tanggal akhir - tanggal awal jadi + sisa cuti / dd($sisaCuti + $data_days);

                if ($permohonan) {
                    if ($sisaCuti < 0) {
                        if (Auth()->user()->role_id != 1) {
                            return redirect()
                                ->route('riwayat.permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        } else {
                            return redirect()
                                ->route('permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        }
                    } else {
                        if ($durasi->days <= 0) {
                            if (Auth()->user()->role_id != 1) {
                                return redirect()
                                    ->route('permohonan')
                                    ->with([
                                        'error' => 'Silahkan periksa kembali tanggal cuti',
                                    ]);
                            } else {
                                return redirect()
                                    ->route('permohonan')
                                    ->with(['error' => 'Silahkan periksa kembali tanggal cuti']);
                            }
                        } else {
                            $validasiData = Validator::make($request->all(), [
                                'alasan_cuti_lainnya' => 'required',
                                'alasan_cuti' => 'required',
                                'tgl_mulai' => 'required',
                                'tgl_akhir' => 'required',
                                'alamat_cuti' => 'required|max:255',
                            ]);
                            if ($validasiData->fails()) {
                                return back()
                                    ->withInput()
                                    ->with(['error' => 'Silahkan periksa alasan cuti!']);
                            } else {
                                $name_cuti = $request->alasan_cuti;
                                $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                                if (Auth()->user()->role_id != null) {
                                    $data = ([
                                        'alasan_cuti' => $request->alasan_cuti_lainnya,
                                        'jenis_cuti_id' => $id_cuti,
                                        'tgl_mulai' => $request->tgl_mulai,
                                        'tgl_akhir' => $request->tgl_akhir,
                                        'alamat_cuti' => $request->alamat_cuti,
                                        'status' => $permohonan->status,
                                        'updated_at' => Carbon::now(),
                                    ]);
                                }
                                
                            
        
                                    if ($tglAkhir > $tglMulai) {
                                        
                                            $hak_cuti = [
                                                'hak_cuti' => $sisaCuti + $requ_days,
                                            ];
        
                                            HakCuti::whereId($id)->update($hak_cuti);
        
                                        
                                        
                                    } else {
                                        return back()->with(['error' => 'Tanggal cuti salah!']);
                                    }
                                
                                
        
                                PermohonanModel::whereId($id_permohonan)->update($data);
                                if (Auth()->user()->role_id != 1) {
                                    return redirect()
                                        ->route('riwayat.permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                } else {
                                    return redirect()
                                        ->route('permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                }
                            }
                        }
                    }
                } else {
                    return back()->with(['error' => 'Edit gagal!']);
                }
                
            } else {
                //biasa

                if ($permohonan) {
                    if ($sisaCuti < 0) {
                        if (Auth()->user()->role_id != 1) {
                            return redirect()
                                ->route('riwayat.permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        } else {
                            return redirect()
                                ->route('permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        }
                    } else {
                        if ($durasi->days <= 0) {
                            if (Auth()->user()->role_id != 1) {
                                return redirect()
                                    ->route('permohonan')
                                    ->with([
                                        'error' => 'Silahkan periksa kembali tanggal cuti',
                                    ]);
                            } else {
                                return redirect()
                                    ->route('permohonan')
                                    ->with(['error' => 'Silahkan periksa kembali tanggal cuti']);
                            }
                        } else {
                            $validasiData = Validator::make($request->all(), [
                                'alasan_cuti_lainnya' => 'required',
                                'alasan_cuti' => 'required',
                                'tgl_mulai' => 'required',
                                'tgl_akhir' => 'required',
                                'alamat_cuti' => 'required|max:255',
                            ]);
                            if ($validasiData->fails()) {
                                return back()
                                    ->withInput()
                                    ->with(['error' => 'Silahkan periksa alasan cuti!']);
                            } else {
                                $name_cuti = $request->alasan_cuti;
                                $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                                if (Auth()->user()->role_id != null) {
                                    $data = ([
                                        'alasan_cuti' => $request->alasan_cuti_lainnya,
                                        'jenis_cuti_id' => $id_cuti,
                                        'tgl_mulai' => $request->tgl_mulai,
                                        'tgl_akhir' => $request->tgl_akhir,
                                        'alamat_cuti' => $request->alamat_cuti,
                                        'status' => $permohonan->status,
                                        'updated_at' => Carbon::now(),
                                    ]);
                                }
                                
                                //untuk tahunan
                                if ($request->alasan_cuti == 'Cuti Tahunan') {
        
                                    if ($tglAkhir > $tglMulai) {
                                        if ($data_days ==  $requ_days) {
                                        } elseif ($data_days >  $requ_days) {
                                            $tambah = $data_days - $requ_days;
                                            $hak_cuti = [
                                                'hak_cuti' => $sisaCuti + $tambah,
                                            ];
        
                                            HakCuti::whereId($id)->update($hak_cuti);
        
                                        } elseif ($data_days <  $requ_days) {
                                            $kurang = $requ_days - $data_days;
                                            $hak_cuti = [
                                                'hak_cuti' => $sisaCuti - $kurang,
                                            ];
                                                
                                                if($sisaCuti - $kurang < 0){
                                                    return back()->with(['error' => 'Sisa Cuti Kurang']);
                                                } else{
        
                                                    HakCuti::whereId($id)->update($hak_cuti);
                                                }
                                        }
                                        
                                    } else {
                                        return back()->with(['error' => 'Tanggal cuti salah!']);
                                    }
                                }
                                
        
                                PermohonanModel::whereId($id_permohonan)->update($data);
                                if (Auth()->user()->role_id != 1) {
                                    return redirect()
                                        ->route('riwayat.permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                } else {
                                    return redirect()
                                        ->route('permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                }
                            }
                        }
                    }
                } else {
                    return back()->with(['error' => 'Edit gagal!']);
                }


            }
        } else {
            if ($request->alasan_cuti != 'Cuti Tahunan'){
                // biasa


                if ($permohonan) {
                    if ($sisaCuti < 0) {
                        if (Auth()->user()->role_id != 1) {
                            return redirect()
                                ->route('riwayat.permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        } else {
                            return redirect()
                                ->route('permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        }
                    } else {
                        if ($durasi->days <= 0) {
                            if (Auth()->user()->role_id != 1) {
                                return redirect()
                                    ->route('permohonan')
                                    ->with([
                                        'error' => 'Silahkan periksa kembali tanggal cuti',
                                    ]);
                            } else {
                                return redirect()
                                    ->route('permohonan')
                                    ->with(['error' => 'Silahkan periksa kembali tanggal cuti']);
                            }
                        } else {
                            $validasiData = Validator::make($request->all(), [
                                'alasan_cuti_lainnya' => 'required',
                                'alasan_cuti' => 'required',
                                'tgl_mulai' => 'required',
                                'tgl_akhir' => 'required',
                                'alamat_cuti' => 'required|max:255',
                            ]);
                            if ($validasiData->fails()) {
                                return back()
                                    ->withInput()
                                    ->with(['error' => 'Silahkan periksa alasan cuti!']);
                            } else {
                                $name_cuti = $request->alasan_cuti;
                                $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                                if (Auth()->user()->role_id != null) {
                                    $data = ([
                                        'alasan_cuti' => $request->alasan_cuti_lainnya,
                                        'jenis_cuti_id' => $id_cuti,
                                        'tgl_mulai' => $request->tgl_mulai,
                                        'tgl_akhir' => $request->tgl_akhir,
                                        'alamat_cuti' => $request->alamat_cuti,
                                        'status' => $permohonan->status,
                                        'updated_at' => Carbon::now(),
                                    ]);
                                }
                                
                                //untuk tahunan
                                if ($request->alasan_cuti == 'Cuti Tahunan') {
        
                                    if ($tglAkhir > $tglMulai) {
                                        if ($data_days ==  $requ_days) {
                                        } elseif ($data_days >  $requ_days) {
                                            $tambah = $data_days - $requ_days;
                                            $hak_cuti = [
                                                'hak_cuti' => $sisaCuti + $tambah,
                                            ];
        
                                            HakCuti::whereId($id)->update($hak_cuti);
        
                                        } elseif ($data_days <  $requ_days) {
                                            $kurang = $requ_days - $data_days;
                                            $hak_cuti = [
                                                'hak_cuti' => $sisaCuti - $kurang,
                                            ];
                                                
                                                if($sisaCuti - $kurang < 0){
                                                    return back()->with(['error' => 'Sisa Cuti Kurang']);
                                                } else{
        
                                                    HakCuti::whereId($id)->update($hak_cuti);
                                                }
                                        }
                                        
                                    } else {
                                        return back()->with(['error' => 'Tanggal cuti salah!']);
                                    }
                                }
                                
        
                                PermohonanModel::whereId($id_permohonan)->update($data);
                                if (Auth()->user()->role_id != 1) {
                                    return redirect()
                                        ->route('riwayat.permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                } else {
                                    return redirect()
                                        ->route('permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                }
                            }
                        }
                    }
                } else {
                    return back()->with(['error' => 'Edit gagal!']);
                }



            } else {
                // tanggal akhir - tanggal mulai ke sisa cuti / dd($sisacuti - $requ_days)


                if ($permohonan) {
                    if ($sisaCuti < 0) {
                        if (Auth()->user()->role_id != 1) {
                            return redirect()
                                ->route('riwayat.permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        } else {
                            return redirect()
                                ->route('permohonan')
                                ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
                        }
                    } else {
                        if ($durasi->days <= 0) {
                            if (Auth()->user()->role_id != 1) {
                                return redirect()
                                    ->route('permohonan')
                                    ->with([
                                        'error' => 'Silahkan periksa kembali tanggal cuti',
                                    ]);
                            } else {
                                return redirect()
                                    ->route('permohonan')
                                    ->with(['error' => 'Silahkan periksa kembali tanggal cuti']);
                            }
                        } else {
                            $validasiData = Validator::make($request->all(), [
                                'alasan_cuti_lainnya' => 'required',
                                'alasan_cuti' => 'required',
                                'tgl_mulai' => 'required',
                                'tgl_akhir' => 'required',
                                'alamat_cuti' => 'required|max:255',
                            ]);
                            if ($validasiData->fails()) {
                                return back()
                                    ->withInput()
                                    ->with(['error' => 'Silahkan periksa alasan cuti!']);
                            } else {
                                $name_cuti = $request->alasan_cuti;
                                $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
                                if (Auth()->user()->role_id != null) {
                                    $data = ([
                                        'alasan_cuti' => $request->alasan_cuti_lainnya,
                                        'jenis_cuti_id' => $id_cuti,
                                        'tgl_mulai' => $request->tgl_mulai,
                                        'tgl_akhir' => $request->tgl_akhir,
                                        'alamat_cuti' => $request->alamat_cuti,
                                        'status' => $permohonan->status,
                                        'updated_at' => Carbon::now(),
                                    ]);
                                }
                                
                               
                                    if ($tglAkhir > $tglMulai) {
                                        
                                            
        
                                            if($sisaCuti - $requ_days < 0){
                                                return back()->with(['error' => 'Sisa Cuti Kurang']);
                                            } else{
                                                $hak_cuti = [
                                                    'hak_cuti' => $sisaCuti - $requ_days,
                                                ];
                                                HakCuti::whereId($id)->update($hak_cuti);
                                            }
        
                                        
                                    } else {
                                        return back()->with(['error' => 'Tanggal cuti salah!']);
                                    }
                                
                                
        
                                PermohonanModel::whereId($id_permohonan)->update($data);
                                if (Auth()->user()->role_id != 1) {
                                    return redirect()
                                        ->route('riwayat.permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                } else {
                                    return redirect()
                                        ->route('permohonan')
                                        ->with([
                                            'success' => 'Berhasil Edit Permohonan Cuti',
                                        ]);
                                }
                            }
                        }
                    }
                } else {
                    return back()->with(['error' => 'Edit gagal!']);
                }


            }
        }
        





        // if ($permohonan) {
        //     if ($sisaCuti < 0) {
        //         if (Auth()->user()->role_id != 1) {
        //             return redirect()
        //                 ->route('riwayat.permohonan')
        //                 ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
        //         } else {
        //             return redirect()
        //                 ->route('permohonan')
        //                 ->with(['error' => 'Maaf sisa cuti anda sudah habis']);
        //         }
        //     } else {
        //         if ($durasi->days <= 0) {
        //             if (Auth()->user()->role_id != 1) {
        //                 return redirect()
        //                     ->route('permohonan')
        //                     ->with([
        //                         'error' => 'Silahkan periksa kembali tanggal cuti',
        //                     ]);
        //             } else {
        //                 return redirect()
        //                     ->route('permohonan')
        //                     ->with(['error' => 'Silahkan periksa kembali tanggal cuti']);
        //             }
        //         } else {
        //             $validasiData = Validator::make($request->all(), [
        //                 'alasan_cuti_lainnya' => 'required',
        //                 'alasan_cuti' => 'required',
        //                 'tgl_mulai' => 'required',
        //                 'tgl_akhir' => 'required',
        //                 'alamat_cuti' => 'required|max:255',
        //             ]);
        //             if ($validasiData->fails()) {
        //                 return back()
        //                     ->withInput()
        //                     ->with(['error' => 'Silahkan periksa alasan cuti!']);
        //             } else {
        //                 $name_cuti = $request->alasan_cuti;
        //                 $id_cuti = JenisCuti::where('jenis_cuti', $name_cuti)->value('id');
        //                 if (Auth()->user()->role_id != null) {
        //                     $data = ([
        //                         'alasan_cuti' => $request->alasan_cuti_lainnya,
        //                         'jenis_cuti_id' => $id_cuti,
        //                         'tgl_mulai' => $request->tgl_mulai,
        //                         'tgl_akhir' => $request->tgl_akhir,
        //                         'alamat_cuti' => $request->alamat_cuti,
        //                         'status' => $permohonan->status,
        //                         'updated_at' => Carbon::now(),
        //                     ]);
        //                 }
                        
        //                 //untuk tahunan
        //                 if ($request->alasan_cuti == 'Cuti Tahunan') {

        //                     if ($tglAkhir > $tglMulai) {
        //                         if ($data_days ==  $requ_days) {
        //                         } elseif ($data_days >  $requ_days) {
        //                             $tambah = $data_days - $requ_days;
        //                             $hak_cuti = [
        //                                 'hak_cuti' => $sisaCuti + $tambah,
        //                             ];

        //                             HakCuti::whereId($id)->update($hak_cuti);

        //                         } elseif ($data_days <  $requ_days) {
        //                             $kurang = $requ_days - $data_days;
        //                             $hak_cuti = [
        //                                 'hak_cuti' => $sisaCuti - $kurang,
        //                             ];
        //                                 
        //                                 if($sisaCuti - $kurang < 0){
        //                                     return back()->with(['error' => 'Sisa Cuti Kurang']);
        //                                 } else{

        //                                     HakCuti::whereId($id)->update($hak_cuti);
        //                                 }
        //                         }
                                
        //                     } else {
        //                         return back()->with(['error' => 'Tanggal cuti salah!']);
        //                     }
        //                 }
                        

        //                 PermohonanModel::whereId($id_permohonan)->update($data);
        //                 if (Auth()->user()->role_id != 1) {
        //                     return redirect()
        //                         ->route('riwayat.permohonan')
        //                         ->with([
        //                             'success' => 'Berhasil Edit Permohonan Cuti',
        //                         ]);
        //                 } else {
        //                     return redirect()
        //                         ->route('permohonan')
        //                         ->with([
        //                             'success' => 'Berhasil Edit Permohonan Cuti',
        //                         ]);
        //                 }
        //             }
        //         }
        //     }
        // } else {
        //     return back()->with(['error' => 'Edit gagal!']);
        // }
    }

    //Function View Permohonan
    public function permohonan()
    {
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', auth()->user()->id)->pluck('hak_cuti');
        //View Pending Bagian Kepegawaian
        if (auth()->user()->role_id == 4) {
            $permohonan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where([
                    ['permohonan_cuti.status', '!=', "4"],
                    ['permohonan_cuti.status', '!=', "5"],
                    ['permohonan_cuti.status', '!=', "0"],
                ])
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
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }
        //View Pending Wakil Direktur
        if (auth()->user()->role_id == 3) {
            $permohonan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.status', '=', 2)
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
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }
        //View Pending Pegawai
        if (auth()->user()->role_id == 1) {
            $permohonan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
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
                ->where('permohonan_cuti.status', '=', 1)
                ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
                ->orderBy('permohonan_cuti.created_at', 'DESC')
                ->get();
        }
        //View Pending Kepala Unit
        if (auth()->user()->role_id == 2) {
            $permohonan = User::join(
                'permohonan_cuti',
                'users.id',
                '=',
                'permohonan_cuti.user_id'
            )
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('permohonan_cuti.status', '=', 1)
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
                ->orderBy('permohonan_cuti.created_at', 'DESC')
                ->get();
        }
        //View Pending Direktur
        if (auth()->user()->role_id == 5) {
            $permohonan = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where(function ($query) {
                    $query->where('users.role_id', 2)
                        ->orWhere('users.role_id', 3);
                })
                ->where('permohonan_cuti.status', 3)
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
                ->orderBy('permohonan_cuti.created_at', 'DESC')
                ->get();
        }
        // dd($permohonan);
        return view('permohonancuti.index', compact('permohonan', 'sisacuti'));
    }

    //Acc Permohonan
    public function setujui_permohonan($id)
    {
        $permohonan = PermohonanModel::findorFail($id);
        if ($permohonan) {
            //Acc Kepala Unit
            if (auth()->user()->role_id == 2) {
                $data = ([
                    'alasan_cuti' => $permohonan->alasan_cuti,
                    'tgl_mulai' => $permohonan->tgl_mulai,
                    'tgl_akhir' => $permohonan->tgl_akhir,
                    'alamat_cuti' => $permohonan->alamat_cuti,
                    'status' => 2,
                    'updated_at' => Carbon::now(),
                ]);
                PermohonanModel::whereId($id)->update($data);



                //email
                $cekemail = DB::table('permohonan_cuti')
                    ->join('jenis_cutis', 'jenis_cutis.id', '=', 'permohonan_cuti.jenis_cuti_id')
                    ->join('users', 'users.id', '=', 'permohonan_cuti.user_id')
                    ->join('hak_cuti', 'hak_cuti.user_id', '=', 'permohonan_cuti.user_id')
                    ->where('permohonan_cuti.id', $id)
                    ->first();

                // dd($cekemail);

                $mailData = [
                    'title' => 'Mail from SICUTE',
                    'body' => 'Assalamualaikum',
                    'name' => $cekemail->name,
                    'sisa_cuti' => $cekemail->hak_cuti,
                    'jenis_cuti' => $cekemail->jenis_cuti,
                    'alasan_cuti' => $cekemail->alasan_cuti,
                    'tgl_mulai' => $cekemail->tgl_mulai,
                    'tgl_akhir' => $cekemail->tgl_akhir,
                    'alamat_cuti' => $cekemail->alamat_cuti,
                ];
                // dd($mailData);

                // dd($cekemail->alasan_cuti);
                // if ($cekemail->status == 2) {
                $wadir = User::where('role_id', 3)->get();
                foreach ($wadir as $p) {

                    Mail::to($p->email)->send(new sicute($mailData));
                }
                // }





                return back()->with(['success' => 'Permohonan Cuti Berhasil Disetujui kepala bagian!',]);
            }
            //Acc Wakil Direktur II & Direktur
            elseif (auth()->user()->role_id == 3) {

                $cekrole = DB::table('permohonan_cuti')
                    ->join('jenis_cutis', 'jenis_cutis.id', '=', 'permohonan_cuti.jenis_cuti_id')
                    ->join('users', 'users.id', '=', 'permohonan_cuti.user_id')
                    ->join('hak_cuti', 'hak_cuti.user_id', '=', 'permohonan_cuti.user_id')
                    ->where('permohonan_cuti.id', $id)
                    ->first();

                if ($cekrole->role_id == 2) {
                    $data = ([
                        'alasan_cuti' => $permohonan->alasan_cuti,
                        'tgl_mulai' => $permohonan->tgl_mulai,
                        'tgl_akhir' => $permohonan->tgl_akhir,
                        'alamat_cuti' => $permohonan->alamat_cuti,
                        'status' => 3,
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    $data = ([
                        'alasan_cuti' => $permohonan->alasan_cuti,
                        'tgl_mulai' => $permohonan->tgl_mulai,
                        'tgl_akhir' => $permohonan->tgl_akhir,
                        'alamat_cuti' => $permohonan->alamat_cuti,
                        'status' => 4,
                        'updated_at' => Carbon::now(),
                    ]);
                }







                PermohonanModel::whereId($id)->update($data);




                if (auth()->user()->role_id == 3) {
                    //email
                    $cekemail = DB::table('permohonan_cuti')
                        ->join('jenis_cutis', 'jenis_cutis.id', '=', 'permohonan_cuti.jenis_cuti_id')
                        ->join('users', 'users.id', '=', 'permohonan_cuti.user_id')
                        ->join('hak_cuti', 'hak_cuti.user_id', '=', 'permohonan_cuti.user_id')
                        ->where('permohonan_cuti.id', $id)
                        ->first();

                    // dd($cekemail->role_id == 2);
                    if ($cekemail->role_id == 2) {



                        $mailData = [
                            'title' => 'Mail from SICUTE',
                            'body' => 'Assalamualaikum',
                            'name' => $cekemail->name,
                            'sisa_cuti' => $cekemail->hak_cuti,
                            'jenis_cuti' => $cekemail->jenis_cuti,
                            'alasan_cuti' => $cekemail->alasan_cuti,
                            'tgl_mulai' => $cekemail->tgl_mulai,
                            'tgl_akhir' => $cekemail->tgl_akhir,
                            'alamat_cuti' => $cekemail->alamat_cuti,
                        ];
                        // dd($mailData);

                        // dd($cekemail->alasan_cuti);
                        // if ($cekemail->status == 2) {
                        $direktur = User::where('role_id', 5)->get();
                        // dd($direktur);
                        foreach ($direktur as $p) {

                            Mail::to($p->email)->send(new sicute($mailData));
                        }
                        // } 
                    }
                }







                return back()->with(['success' => 'Permohonan Cuti Berhasil Disetujui!',]);
            } elseif (auth()->user()->role_id == 5) {


                $data = ([
                    'alasan_cuti' => $permohonan->alasan_cuti,
                    'tgl_mulai' => $permohonan->tgl_mulai,
                    'tgl_akhir' => $permohonan->tgl_akhir,
                    'alamat_cuti' => $permohonan->alamat_cuti,
                    'status' => 4,
                    'updated_at' => Carbon::now(),
                ]);

                PermohonanModel::whereId($id)->update($data);


                return back()->with(['success' => 'Permohonan Cuti Berhasil Disetujui!',]);
            }
        }
        return back()->with(['error' => 'Permohonan Cuti Tidak Ditemukan!',]);
    }

    //Tolak Permohonan
    public function tolak_permohonan(Request $request, $id_permohonan)
    {
        $permohonan = PermohonanModel::findorFail($id_permohonan);
        $user_id = $permohonan->user_id;
        $data = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', $user_id)
            ->get();
        $sisaCuti = $data[0]->hak_cuti;
        $a = date_create($permohonan->tgl_mulai);
        $b = date_create($permohonan->tgl_akhir);
        $data_db = date_diff($a, $b);
        $data_days = $data_db->days;
        $data = ([
            'alasan_cuti' => $permohonan->alasan_cuti,
            'tgl_mulai' => $permohonan->tgl_mulai,
            'tgl_akhir' => $permohonan->tgl_akhir,
            'alamat_cuti' => $permohonan->alamat_cuti,
            'status' => 5,
            'alasan_ditolak' => $request->alasan_ditolak,
            'updated_at' => Carbon::now(),
        ]);
        PermohonanModel::whereId($id_permohonan)->update($data);



        $id_cuti = $permohonan->jenis_cuti_id;
        $name_cuti = JenisCuti::where('id', $id_cuti)->value('jenis_cuti');

        // dd($name_cuti);
        if ($name_cuti == 'Cuti Tahunan') {


            $hak_cuti = [
                'hak_cuti' => $sisaCuti + $data_days,
            ];
            HakCuti::whereId($user_id)->update($hak_cuti);
        }
        return back()->with(['success' => 'Permohonan Cuti Berhasil Ditolak!',]);
    }

    //Batalkan Permohonan
    public function batalkan_permohonan(Request $request, $id_permohonan)
    {
        $permohonan = PermohonanModel::findorFail($id_permohonan);
        $user_id = $permohonan->user_id;
        $data = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', $user_id)
            ->get();
        $sisaCuti = $data[0]->hak_cuti;
        $a = date_create($permohonan->tgl_mulai);
        $b = date_create($permohonan->tgl_akhir);
        $data_db = date_diff($a, $b);
        $data_days = $data_db->days;
        $data = ([
            'alasan_cuti' => $permohonan->alasan_cuti,
            'tgl_mulai' => $permohonan->tgl_mulai,
            'tgl_akhir' => $permohonan->tgl_akhir,
            'alamat_cuti' => $permohonan->alamat_cuti,
            'status' => 0,
            'alasan_ditolak' => $request->alasan_ditolak,
            'updated_at' => Carbon::now(),
        ]);
        PermohonanModel::whereId($id_permohonan)->update($data);
        $id_cuti = $permohonan->jenis_cuti_id;
        $name_cuti = JenisCuti::where('id', $id_cuti)->value('jenis_cuti');

        // dd($name_cuti);
        if ($name_cuti == 'Cuti Tahunan') {

            $hak_cuti = [
                'hak_cuti' => $sisaCuti + $data_days,
            ];
            HakCuti::whereId($user_id)->update($hak_cuti);
        }

        return redirect()->route('permohonandibatalkan')->with(['success' => 'Permohonan Cuti Berhasil Dibatalkan!',]);
    }
}
