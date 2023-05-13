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
                                            @if (auth()->user()->role_id == 4)
                                            <th class="text-center">Opsi</th>
                                            @endif
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
                                                    @if (auth()->user()->role_id == 4)
                                                    <td class="text-truncate">
                                                        <button class="btn btn-danger btn-action " data-toggle="modal"
                                                            data-target="#tolak-modal{{ $p->id }}">Batal</button>
                                                    </td>
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
        @foreach ($permohonan_disetujui as $p)
            <div class="modal fade " id="tolak-modal{{ $p->id }}" tabindex="-1" role="dialog"
                aria-labelledby="formModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Konfirmasi Batal Permohonan Cuti</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('batal.permohonancuti', ['id_permohonan' => $p->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Alasan Dibatalkan</label>
                                    <textarea class="form-control" name="alasan_ditolak"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
