@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    @if ($errors->has('name_unit'))
                                    @endif
                                </div>
                        @endif
                        <div class="card-header">
                            <h4>Data Unit</h4>
                        </div>
                        <div class="ml-4 mt-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Unit</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dt-dashboard">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-left" style="width: 50%">Nama Unit</th>
                                                <th class="text-center">Total Pegawai</th>
                                                <th class="text-center">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($units as $u)
                                                <tr>
                                                    <td class="text-center">{{ $i++ }}</td>
                                                    <td class="text-left">{{ $u->name_unit }}</td>
                                                    <td class="text-center">{{ $totalPegawaiPerUnit[$u->name_unit] ?? 0 }}</td>
                                                    <td class="align-center">
                                                            <button type="button" class="btn btn-action bg-purple"
                                                                data-toggle="modal"
                                                                data-target="#modal-edit{{ $u->id }}">Edit
                                                            </button>
                                                        <a class="btn btn-danger delete-confirm"
                                                            href="{{ route('hapusunit', ['id' => $u->id]) }}"
                                                            style="display: inline-block;">Hapus</a>
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
            </div>
    </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModal">Tambah Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" action="tambahunit" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nama Unit</label>
                                <input type="text" class="form-control" value="" name="name_unit" required>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    @foreach ( $units as $u)
    <div class="modal fade" id="modal-edit{{ $u->id }}" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Form Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('edit.unit', $u->id) }}" method="post"
                    id="edit">
                    @csrf
                    <div class="form-group">
                        <label>Nama Unit</label>
                        <input type="text" class="form-control" value="{{ $u->name_unit }}" name="name_unit" required>
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
