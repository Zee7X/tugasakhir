@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Permohonan Cuti Dibatalkan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Jenis Cuti</th>
                                            <th class="text-center">Alasan Dibatalkan</th>
                                            <th class="text-center">Mulai Cuti</th>
                                            <th class="text-center">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{ $i = 1 }}">
                                            @foreach ($permohonan_dibatalkan as $p)
                                                <tr>
                                                    <td class="text-center">{{ $i++ }}</td>
                                                    <td class="text-center">{{ $p->name }}</td>
                                                    <td class="text-center">{{ $p->nip }}</td>
                                                    <td class="text-center">{{ $p->jabatan }}</td>
                                                    <td class="text-center">{{ $p->name_unit }}</td>
                                                    <td class="text-center">{{ $p->jenis_cuti }}</td>
                                                    <td class="text-center">{{ $p->alasan_ditolak }}</td>
                                                    <td class="text-center">
                                                        {{ date('d-M-Y', strtotime($p->tgl_mulai)) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ date('d-M-Y', strtotime($p->tgl_akhir)) }}
                                                    </td>
                                                        <td class="text-center"><span style="padding: 8px 20px"
                                                                class="badge badge-danger">Dibatalkan</span></td>
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
