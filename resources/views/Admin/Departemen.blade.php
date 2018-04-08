@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Departemen Telah Di Tambahkan",
                    icon: "success",
                    button: false,
                    timer: 2000
                });
            })
        </script>
    @elseif(session()->has('update'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Departemen Telah Di Perbarui",
                    icon: "success",
                    button: false,
                    timer: 2000
                });
            })
        </script>
    @elseif(session()->has('hapus'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Departemen Telah Di Hapus",
                    icon: "success",
                    button: false,
                    timer: 2000
                });
            })
        </script>
    @endif

    <script type="text/javascript">
        /*ini javascript buat konfirmasi delete*/
        $(document).ready(function(){
            $(".hapus").submit(function(event) {
                var form = this;
                event.preventDefault();
                swal({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang hilang tidak akan kembali",
                    icon: 'warning',
                    buttons: true
                }).then(function (isConfirm) {
                    if (isConfirm){
                        form.submit();
                    } else {
                        swal('Cancelled', '', 'error');
                    }
                })
            });
        });
    </script>

    <div class="container putih">
        <h2 style="">Departemen</h2>
        {{--jika yang login fakultas--}}
        @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
        \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
        \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
            <a href="{{ url('admin/departemen/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Departemen</button></a>
        @endif
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped responsive">
                    <thead>
                    <tr>
                        <th>ID Departemen</th>
                        <th>Nama Departemen</th>
                        <th>ID Fakultas</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($departemen as $data)
                        <tr>
                            <td>{{ $data->id_departemen }}</td>
                            <td>{{ $data->nama_departemen }}</td>
                            <td>{{ $data->id_fakultas }}</td>
                            <td>
                                {!! Form::open(['route' => ['departemen.destroy', $data->id_departemen], 'method' => 'delete', 'class' => 'hapus']) !!}
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div>

    </div>

    <script>
        /*javascript untuk table nya*/
        $(document).ready( function () {
            $('#example1').DataTable();
        } );
    </script>

@endsection