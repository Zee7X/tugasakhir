@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
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
                                                <th class="text-left" style="width: 20%">Nama Unit</th>
                                                <th class="text-center">Total Pegawai</th>
                                                <th class="text-center">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($unit as $u)
                                                <tr>
                                                    <td class="text-center" style="font-size: 16px">{{ $i++ }}</td>
                                                    <td class="text-left" style="font-size: 16px">{{ $u->name_unit }}</td>
                                                    <td class="text-center" style="font-size: 16px">10</td>
                                                    <td class="align-center">
                                                        <a class="btn btn-danger delete-confirm"
                                                            href=""
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
                        <form class="" action="" method="">
                            @csrf
                            <div class="form-group">
                                <label>Nama Unit</label>
                                <input type="text" class="form-control" value="" name="" required>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
