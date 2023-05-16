@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Permohonan Cuti Disetujui</h4>
                        </div>
                        @if (auth()->user()->role_id == 4)
                        <div class="ml-4 mt-3">
                            <button class="btn btn-success" data-toggle="" data-target="">Export Laporan</button>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pegawai</th>
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
                                            @foreach ($permohonan_disetujui as $p)
                                                <tr>
                                                    <td class="text-center">{{ $i++ }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td class="text-truncate">{{ $p->nip }}</td>
                                                    <td  class="align-center">{{ $p->jabatan }}</td>
                                                    <td  class="align-center">{{ $p->name_unit }}</td>
                                                    {{-- @if (auth()->user()->role_id == 4)
                                                    <td class="align-center">{{ $p->hak_cuti }}</td>
                                                    @endif --}}
                                                    <td>{{ $p->alasan_cuti }}</td>
                                                    <td class="text-truncate">
                                                        {{ date('d-M-Y', strtotime($p->tgl_mulai)) }}
                                                    </td>
                                                    <td class="align-center">
                                                        {{ date('d-M-Y', strtotime($p->tgl_akhir)) }}
                                                    </td>
                                                        <td class="text-center"><span style="padding: 8px 45px"
                                                                class="badge badge-success">Disetujui</span>
                                                        </td>
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
