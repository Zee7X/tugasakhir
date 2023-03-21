@extends('layouts.index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-cyan-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                @if (auth()->user()->role_id == 1)
                                    <h4 class="card-title">Sisa Cuti</h4>
                                    @foreach ($sisacuti as $d)
                                        <span>{{ $d->hak_cuti }} Hari</span>
                                    @endforeach
                                @else
                                    <h4 class="card-title">Permohonan Cuti</h4>
                                    <span>{{ $pending }}</span>
                                @endif
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @if (auth()->user()->role_id == 1)
                                    <p class="mb-0 text-sm">
                                        <span class="mr-1"><i class="far fa-calendar-plus"></i></span>
                                        <a href="/permohonan" class="text-white">Permohonan</a>
                                    </p>
                                @else
                                    <p class="mb-0 text-sm">
                                        <span class="mr-1"><i class="fas fa-eye"></i></span>
                                        <a href="/permohonan" class="text-white">Lihat Detail</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-purple-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Permohonan Disetujui</h4>
                                @if (auth()->user()->role_id == 1)
                                    <span>{{ $disetujui2 }}</span>
                                @elseif (auth()->user()->role_id == 2)
                                    <span>{{ $disetujui3 }}</span>
                                @else ()
                                    <span>{{ $disetujui }}</span>
                                @endif
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-1"><i class="fas fa-eye"></i></span>
                                    <a href="/permohonandisetujui" class="text-white">Lihat Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Permohonan Ditolak</h4>
                                @if (auth()->user()->role_id == 1)
                                    <span>{{ $ditolak2 }}</span>
                                @elseif (auth()->user()->role_id == 2)
                                    <span>{{ $ditolak3 }}</span>
                                @else ()
                                    <span>{{ $ditolak }}</span>
                                @endif
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-green" role="progressbar" data-width="100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-1"><i class="fas fa-eye"></i></span>
                                    <a href="/permohonanditolak" class="text-white">Lihat Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Permohonan Cuti Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Unit</th>
                                            <th>Alasan Cuti</th>
                                            <th class="text-center">Mulai Cuti</th>
                                            <th class="text-center">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{ $i = 1 }}">
                                        @if (auth()->user()->role_id == 1)
                                            @foreach ($dashboard2 as $user)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->jabatan }}</td>
                                                @if ($user->unit_id == 1)
                                                    <td>Direksi</td>
                                                @elseif ($user->unit_id == 2)
                                                    <td>SPI</td>
                                                @elseif ($user->unit_id == 3)
                                                    <td>P4MP</td>
                                                @elseif ($user->unit_id == 4)
                                                    <td>PPM</td>
                                                @elseif ($user->unit_id == 5)
                                                    <td>Teknik Informatika</td>
                                                @elseif ($user->unit_id == 6)
                                                    <td>Teknik Mesin</td>
                                                @elseif ($user->unit_id == 7)
                                                    <td>Teknik Elektronika</td>
                                                @elseif ($user->unit_id == 8)
                                                    <td>Teknik Pencemaran Pengendalian Lingkungan</td>
                                                @elseif ($user->unit_id == 9)
                                                    <td>D4 PPA</td>
                                                @elseif ($user->unit_id == 10)
                                                    <td>Umum</td>
                                                @elseif ($user->unit_id == 11)
                                                    <td>Akademik</td>
                                                @elseif ($user->unit_id == 12)
                                                    <td>Keuangan</td>
                                                @elseif ($user->unit_id == 13)
                                                    <td>Teknologi Informasi Komputer</td>
                                                @elseif ($user->unit_id == 14)
                                                    <td>Pemeliharaan</td>
                                                @elseif ($user->unit_id == 15)
                                                    <td>Bahasa</td>
                                                @else
                                                    ()
                                                    <td>Perpustakaan</td>
                                                @endif
                                                <td>{{ $user->alasan_cuti }}</td>
                                                    <td class="text-center">{{ date('d-M-Y', strtotime($user->tgl_mulai)) }}
                                                    </td>
                                                    <td class="text-center">{{ date('d-M-Y', strtotime($user->tgl_akhir)) }}
                                                    </td>
                                                    @if ($user->status == 'Disetujui')
                                                        <td class="text-center"><span
                                                                class="badge badge-success">{{ $user->status }}</span></td>
                                                    @endif
                                                    @if ($user->status == 'Pending')
                                                        <td class="text-center"><span
                                                                class="badge badge-warning">{{ $user->status }}</span></td>
                                                    @endif
                                                    @if ($user->status == 'Ditolak')
                                                        <td class="text-center"><span
                                                                class="badge badge-danger">{{ $user->status }}</span></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @elseif (auth()->user()->role_id == 2)
                                            @foreach ($dashboard3 as $user)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->jabatan }}</td>
                                                @if ($user->unit_id == 1)
                                                    <td>Direksi</td>
                                                @elseif ($user->unit_id == 2)
                                                    <td>SPI</td>
                                                @elseif ($user->unit_id == 3)
                                                    <td>P4MP</td>
                                                @elseif ($user->unit_id == 4)
                                                    <td>PPM</td>
                                                @elseif ($user->unit_id == 5)
                                                    <td>Teknik Informatika</td>
                                                @elseif ($user->unit_id == 6)
                                                    <td>Teknik Mesin</td>
                                                @elseif ($user->unit_id == 7)
                                                    <td>Teknik Elektronika</td>
                                                @elseif ($user->unit_id == 8)
                                                    <td>Teknik Pencemaran Pengendalian Lingkungan</td>
                                                @elseif ($user->unit_id == 9)
                                                    <td>D4 PPA</td>
                                                @elseif ($user->unit_id == 10)
                                                    <td>Umum</td>
                                                @elseif ($user->unit_id == 11)
                                                    <td>Akademik</td>
                                                @elseif ($user->unit_id == 12)
                                                    <td>Keuangan</td>
                                                @elseif ($user->unit_id == 13)
                                                    <td>Teknologi Informasi Komputer</td>
                                                @elseif ($user->unit_id == 14)
                                                    <td>Pemeliharaan</td>
                                                @elseif ($user->unit_id == 15)
                                                    <td>Bahasa</td>
                                                @else
                                                    ()
                                                    <td>Perpustakaan</td>
                                                @endif
                                                <td>{{ $user->alasan_cuti }}</td>
                                                    <td class="text-center">
                                                        {{ date('d-M-Y', strtotime($user->tgl_mulai)) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ date('d-M-Y', strtotime($user->tgl_akhir)) }}
                                                    </td>
                                                    @if ($user->status == 'Disetujui')
                                                        <td class="text-center"><span
                                                                class="badge badge-success">{{ $user->status }}</span></td>
                                                    @endif
                                                    @if ($user->status == 'Pending')
                                                        <td class="text-center"><span
                                                                class="badge badge-warning">{{ $user->status }}</span>
                                                        </td>
                                                    @endif
                                                    @if ($user->status == 'Ditolak')
                                                        <td class="text-center"><span
                                                                class="badge badge-danger">{{ $user->status }}</span></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($dashboard as $user)
                                                <tr>
                                                    <td class="text-center">{{ $i++ }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->jabatan }}</td>
                                                    @if ($user->unit_id == 1)
                                                        <td>Direksi</td>
                                                    @elseif ($user->unit_id == 2)
                                                        <td>SPI</td>
                                                    @elseif ($user->unit_id == 3)
                                                        <td>P4MP</td>
                                                    @elseif ($user->unit_id == 4)
                                                        <td>PPM</td>
                                                    @elseif ($user->unit_id == 5)
                                                        <td>Teknik Informatika</td>
                                                    @elseif ($user->unit_id == 6)
                                                        <td>Teknik Mesin</td>
                                                    @elseif ($user->unit_id == 7)
                                                        <td>Teknik Elektronika</td>
                                                    @elseif ($user->unit_id == 8)
                                                        <td>Teknik Pencemaran Pengendalian Lingkungan</td>
                                                    @elseif ($user->unit_id == 9)
                                                        <td>D4 PPA</td>
                                                    @elseif ($user->unit_id == 10)
                                                        <td>Umum</td>
                                                    @elseif ($user->unit_id == 11)
                                                        <td>Akademik</td>
                                                    @elseif ($user->unit_id == 12)
                                                        <td>Keuangan</td>
                                                    @elseif ($user->unit_id == 13)
                                                        <td>Teknologi Informasi Komputer</td>
                                                    @elseif ($user->unit_id == 14)
                                                        <td>Pemeliharaan</td>
                                                    @elseif ($user->unit_id == 15)
                                                        <td>Bahasa</td>
                                                    @else
                                                        ()
                                                        <td>Perpustakaan</td>
                                                    @endif
                                                    <td>{{ $user->alasan_cuti }}</td>
                                                    <td class="text-center">
                                                        {{ date('d-M-Y', strtotime($user->tgl_mulai)) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ date('d-M-Y', strtotime($user->tgl_akhir)) }}
                                                    </td>
                                                    @if ($user->status == 'Disetujui')
                                                        <td class="text-center"><span
                                                                class="badge badge-success">{{ $user->status }}</span>
                                                        </td>
                                                    @endif
                                                    @if ($user->status == 'Pending')
                                                        <td class="text-center"><span
                                                                class="badge badge-warning">{{ $user->status }}</span>
                                                        </td>
                                                    @endif
                                                    @if ($user->status == 'Ditolak')
                                                        <td class="text-center"><span
                                                                class="badge badge-danger">{{ $user->status }}</span></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
