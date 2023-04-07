@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Permohonan Cuti Ditolak</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Alasan Cuti</th>
                                            <th class="text-truncate">Mulai Cuti</th>
                                            <th class="text-truncate">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{ $i = 1 }}">
                                            @foreach ($permohonan_ditolak as $p)
                                                <tr>
                                                    <td class="text-center">{{ $i++ }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->nip }}</td>
                                                    <td>{{ $p->jabatan }}</td>
                                                    <td>{{ $p->name_unit }}</td>
                                                    <td>{{ $p->alasan_cuti }}</td>
                                                    <td class="text-truncate">
                                                        {{ date('d-M-Y', strtotime($p->tgl_mulai)) }}
                                                    </td>
                                                    <td class="text-truncate">
                                                        {{ date('d-M-Y', strtotime($p->tgl_akhir)) }}
                                                    </td>
                                                    @if ($p->status == 1)
                                                        <td class="text-center"><span
                                                                class="badge badge-warning">Pending Kepala Unit </span></td>
                                                    @elseif ($p->status == 2)
                                                        <td class="text-center"><span
                                                                class="badge badge-warning">Pending Wadir</span></td>
                                                    @elseif ($p->status == 3)
                                                        <td class="text-center"><span
                                                                class="badge badge-warning">Pending Direktur</span></td>
                                                    @elseif ($p->status == 4)
                                                        <td class="text-center"><span
                                                                class="badge badge-success">Disetujui</span></td>
                                                    @elseif ($p->status == 5)
                                                        <td class="text-center"><span
                                                                class="badge badge-danger">Ditolak</span></td>
                                                    @endif
                                                </tr>
                                            @endforeach
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
