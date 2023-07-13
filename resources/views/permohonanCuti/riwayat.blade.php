@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    @if (Session::has('error'))
                        <div id="flash-data" data-flashdata="{{ Session::get('error') }}"></div>
                    @elseif (Session::has('success'))
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Riwayat Permohonan Cuti </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dt-dashboard">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pegawai</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Jenis Cuti</th>
                                            <th class="text-center">Alasan Cuti</th>
                                            <th class="text-center">Mulai Cuti</th>
                                            <th class="text-center">Berakhir Cuti</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($riwayat as $p)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td class="text-center">{{ $p->name }}</td>
                                                <td>{{ $p->jabatan }}</td>
                                                <td class="text-left">{{ $p->name_unit }}</td>
                                                <td class="text-center">{{ $p->jenis_cuti }}</td>
                                                <td class="text-center">{{ $p->alasan_cuti }}</td>
                                                <td class="text-center">
                                                    {{ date('d-M-Y', strtotime($p->tgl_mulai)) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d-M-Y', strtotime($p->tgl_akhir)) }}
                                                </td>
                                                @if ($p->status == 1)
                                                    <td class="text-center"><span class="badge badge-warning"
                                                            style="padding: 8px 20px">Pending Kepala Unit </span></td>
                                                @elseif ($p->status == 2)
                                                    <td class="text-center"><span class="badge badge-warning"
                                                            style="padding: 8px 37px">Pending Wadir</span></td>
                                                @elseif ($p->status == 3)
                                                    <td class="text-center"><span class="badge badge-warning"
                                                            style="padding: 8px 31px">Pending Direktur</span></td>
                                                @elseif ($p->status == 4)
                                                    <td class="text-center"><span class="badge badge-success"
                                                            style="padding: 8px 54px">Disetujui</span></td>
                                                @elseif ($p->status == 5)
                                                    <td class="text-center"><span class="badge badge-danger"
                                                            style="padding: 8px 58px">Ditolak</span></td>
                                                @elseif ($p->status == 0)
                                                    <td class="text-center"><span class="badge badge-danger"
                                                            style="padding: 8px 48px">Dibatalkan</span></td>
                                                @endif
                                                @if (Auth()->user()->role_id == 4)
                                                    @if ($p->status == 1 && Auth::user()->id == $p->user_id)
                                                        <td class="text-truncate"> <button type="button"
                                                                class="btn btn-action bg-purple" data-toggle="modal"
                                                                data-target="#modal-edit{{ $p->id }}"
                                                                data-id="{{ $p->id }}">Edit
                                                            </button>
                                                        </td>
                                                    @elseif ($p->status == 4)
                                                        <td class="text-truncate">
                                                            <button type="button" class="btn btn-action bg-red"
                                                                data-toggle="modal"
                                                                data-target="#modal-batal{{ $p->id }}">Batal
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td class="text-truncate">
                                                        </td>
                                                    @endif
                                                @elseif(Auth()->user()->role_id == 2)
                                                    @if ($p->status == 2 && Auth::user()->id == $p->user_id)
                                                        <td class="text-truncate"> <button type="button"
                                                                class="btn btn-action bg-purple" data-toggle="modal"
                                                                data-target="#modal-edit{{ $p->id }}"
                                                                data-id="{{ $p->id }}">Edit
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td class="text-truncate">
                                                        </td>
                                                    @endif
                                                @elseif(Auth()->user()->role_id == 3)
                                                    @if ($p->status == 3 && Auth::user()->id == $p->user_id)
                                                        <td class="text-truncate"> <button type="button"
                                                                class="btn btn-action bg-purple" data-toggle="modal"
                                                                data-target="#modal-edit{{ $p->id }}"
                                                                data-id="{{ $p->id }}">Edit
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td class="text-truncate">
                                                        </td>
                                                    @endif
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
        {{-- modal batal --}}
        @foreach ($riwayat as $p)
            <div class="modal fade " id="modal-batal{{ $p->id }}" tabindex="-1" role="dialog"
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
                                    <textarea class="form-control" name="alasan_ditolak" required
                                        oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- modal edit --}}
        @foreach ($riwayat as $p)
            <div class="modal fade" id="modal-edit{{ $p->id }}" tabindex="-1" role="dialog"
                aria-labelledby="formModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Form Edit Permohonan Cuti</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="" action="{{ route('edit.permohonancuti', $p->id) }}" method="post"
                                id="edit">
                                @csrf


                                @if ($p->jenis_cuti == 'Cuti Tahunan')
                                    <div id="show-sisa-cuti-edit{{ $p->id }}" class="border py-1"
                                        style="justify-content: center; text-align: center; border-radius: 10px; display: block;">
                                        <label>Sisa Cuti Anda</label><br>
                                        <h6>{{ $sisacuti[0] }}</h6>
                                    @else
                                        <div id="show-sisa-cuti-edit{{ $p->id }}" class="border py-1"
                                            style="justify-content: center; text-align: center; border-radius: 10px; display: none;">
                                            <label>Sisa Cuti Anda</label><br>
                                            <h6>{{ $sisacuti[0] }}</h6>
                                @endif
                        </div><br>


                        <div class="form-group">
                            <label>Jenis Cuti</label>
                            <select class="form-control" name="alasan_cuti"
                                id="alasan_cuti_edit{{ $p->id }}" data-id="{{ $p->id }}" required>
                                <option disabled selected>Pilih Jenis
                                    Cuti</option>
                                @if (auth()->user()->jenis_kelamin != 'Laki-Laki')
                                    <option name="alasan_cuti" value="Cuti Bersalin"
                                        {{ $p->jenis_cuti == 'Cuti Bersalin' ? 'selected' : '' }}>
                                        Cuti Bersalin</option>
                                    <option name="alasan_cuti" value="Gugur Kandungan"
                                        {{ $p->jenis_cuti == 'Gugur Kandungan' ? 'selected' : '' }}>
                                        Gugur Kandungan</option>
                                @endif
                                <option name="alasan_cuti" value="Cuti Besar"
                                    {{ $p->jenis_cuti == 'Cuti Besar' ? 'selected' : '' }}>
                                    Cuti Besar</option>
                                <option name="alasan_cuti" value="Cuti Diluar Tanggungan"
                                    {{ $p->jenis_cuti == 'Cuti Diluar Tanggungan' ? 'selected' : '' }}>
                                    Cuti Diluar Tanggungan
                                </option>
                                <option name="alasan_cuti" value="Cuti Tahunan"
                                    {{ $p->jenis_cuti == 'Cuti Tahunan' ? 'selected' : '' }}>
                                    Cuti Tahunan</option>
                                <option name="alasan_cuti" value="Cuti Ibadah Keagamaan"
                                    {{ $p->jenis_cuti == 'Cuti Ibadah Keagamaan' ? 'selected' : '' }}>
                                    Cuti Ibadah Keagamaan</option>
                                <option name="alasan_cuti" value="Cuti Karena Alasan Penting"
                                    {{ $p->jenis_cuti == 'Cuti Karena Alasan Penting' ? 'selected' : '' }}>
                                    Cuti Karena Alasan Penting
                                </option>
                                {{-- <option name="alasan_cuti" value="Lain - Lain"
                                            {{ $p->alasan_cuti == 'Lain - Lain' ? 'selected' : '' }}>
                                            Lain - Lain</option> --}}
                            </select>
                        </div>
                        <div class="form-group" id="form-cuti-lainnya-edit">
                            <label for="alasan_cuti_lainnya">Alasan Cuti:</label>
                            <input class="form-control" type="text" id="alasan_cuti_lainnya"
                                name="alasan_cuti_lainnya" value="{{ $p->alasan_cuti }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Mulai Cuti</label>
                            <input type="text" name="tgl_mulai" value="{{ $p->tgl_mulai, date('Y-m-d') }}"
                                class="form-control datepicker" required id="start_date">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Berakhir Cuti</label>
                            <input type="text" name="tgl_akhir"
                                value="{{ $p->tgl_akhir, date('Y-m-d', strtotime('+1 day')) }}"
                                class="form-control datepicker" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                id="end_date">
                        </div>
                        <div class="form-group">
                            <label>Alamat Selama Cuti</label>
                            <input type="text" class="form-control" value="{{ $p->alamat_cuti }}" name="alamat_cuti"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
    </div>
    @push('scrip')
        <script>
            $(document).ready(function() {
                $("select[id^='alasan_cuti_edit']").on("change", function() {
                    var selectedValue = $(this).val();
                    var id = $(this).data('id');
                    var ShowSisaCutiEdit = document.getElementById("show-sisa-cuti-edit" + id);
                    console.log(selectedValue);
                    console.log(id);

                    if (selectedValue == "Cuti Besar" || selectedValue == "Cuti Diluar Tanggungan" ||
                        selectedValue == "Cuti Ibadah Keagamaan" || selectedValue ==
                        "Cuti Karena Alasan Penting" || selectedValue == "Cuti Bersalin" || selectedValue ==
                        "Gugur Kandungan") {
                        ShowSisaCutiEdit.style.display = "none";
                    } else {
                        ShowSisaCutiEdit.style.display = "block";
                    }
                });
            });
        </script>
    @endpush
@endsection
