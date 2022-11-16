@extends('layouts/index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Permohonan Cuti</h4>
                        </div>
                        @if (auth()->user()->role_id == 1)
                            <div class="ml-4 mt-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Buat Permohonan Cuti</button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="table-1">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Alasan Cuti</th>
                                        <th>Mulai Cuti</th>
                                        <th>Berakhir Cuti</th>
                                        <th>Status</th>
                                        @if(auth()->user()->role_id !=1)
                                        <th>Opsi</th>
                                        @endif
                                    </tr>

                                    <tr>
                                        <td class="p-0 text-center"></td>
                                        <td class="font-weight-600"></td>
                                        <td class="text-truncate"></td>
                                        <td class="align-middle"></td>
                                        <td class="align-middle"></td>
                                        <td class="align-middle"><span class="badge badge-warning"></span></td>
                                        @if(auth()->user()->role_id !=1)
                                        <td>
                                            <a class="btn btn-action bg-purple mr-1" href="">Setuju</a>
                                            <a class="btn btn-danger btn-action" href="">Tolak</a>
                                        </td>
                                        @endif
                                    </tr>

                                </table>
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
                <h5 class="modal-title" id="formModal">Form Permohonan Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="" method="" >
                @csrf
                  <div class="form-group">
                    <label>Alasan Cuti</label>
                    <textarea class="form-control" name="alasan_cuti" required ></textarea>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Mulai Cuti</label>
                    <input type="text" name="tgl_mulai" required class="form-control datepicker">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Berakhir Cuti</label>
                    <input type="text" name="tgl_akhir" required class="form-control datepicker">
                  </div> 
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>
@endsection
