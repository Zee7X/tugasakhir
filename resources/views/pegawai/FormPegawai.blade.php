@extends('layouts/index')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
            <div class="card">
            <div class="card-header">
                <h4>Data Pegawai</h4>
            </div>
            <div class="card-body">
                <a data-toggle="modal" data-target="#exampleModal" href="#" class="btn btn-primary modall">Tambah Pegawai</a>
                <div class="table-responsive table-invoice">
                <table class="table table-striped" id="table-1">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Unit</th>
                        <th>Jumlah Cuti</th>
                        <th>Opsi</th>
                    </tr>
                    @foreach($users as $i => $k)
                        <tr>
                            <td class="p-0 text-center">{{$i+1}}</td>
                            <td class="font-weight-600">{{$k->name}}</td>
                            <td class="text-truncate">{{$k->nip}}</td>
                            <td class="align-middle">{{$k->jabatan}}</td>
                            <td class="align-middle">{{$k->unit}}</td>
                            <td class="align-middle">{{$k->hak_cuti}} Hari</td> 
                            <td> 
                                <a class="btn btn-action bg-purple mr-1" href="{{route('formedit',['id' => $k->id])}}" >Edit</a>
                            </td>
                        </tr>
                        @endforeach
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Form Tambah Data Pegawai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form class="">
                <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="nama">
                </div>
                </div>
                <div class="form-group">
                <label>NIP</label>
                <div class="input-group">
                    <div class="input-group-prepend"> 
                    </div>
                    <input type="text" class="form-control"  name="nip">
                </div>
                </div>
                <div class="form-group">
                <label>Jabatan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control"  name="jabatan">
                </div>
                </div>
                <div class="form-group">
                <label>Unit</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control"  name="unit">
                </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
                        <input type="text" class="form-control"  name="jenis_kelamin">
                    </div>
                </div>
                    <div class="form-group">
                        <label>Role ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text" class="form-control"  name="role_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Cuti</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text" class="form-control"  name="hak_cuti">
                        </div>
                <button type="button" class="btn btn-primary m-t-15 waves-effect">Tambah Pegawai</button>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(".modall").click(function () {
            var my_id_value = $(this).data('id');
            $(".modal-body #hiddenValue").val(my_id_value);
        })
    });
</script>
@endsection