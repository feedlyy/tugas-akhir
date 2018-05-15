@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Prodi Telah Di Tambahkan",
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
                    text: "Prodi Telah Di Perbarui",
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
                    text: "Prodi Telah Di Hapus",
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
        <h2 style="">Prodi</h2>
        {{--jika yang login fakultas--}}
        @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
        \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
        \Illuminate\Support\Facades\Auth::user()->id_prodi == null ||
        \Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
        \Illuminate\Support\Facades\Auth::user()->id_departemen != null &&
        \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
            <a href="{{ url('admin/prodi/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Prodi</button></a>
        @endif
        {{--<a href="{{ url('admin/acara/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Acara</button></a>--}}
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Prodi</th>
                        <th>Nama Prodi</th>
                        <th>ID Fakultas</th>
                        <th>ID Departemen</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($prodi as $data)
                        <tr>
                            <td>{{ $data->id_prodi }}</td>
                            <td>{{ $data->nama_prodi }}</td>
                            <td>{{ $data->id_fakultas }}</td>
                            <td>{{ $data->id_departemen }}</td>
                            <td>
                                {!! Form::open(['route' => ['prodi.destroy', $data->id_prodi], 'method' => 'delete', 'class' => 'hapus']) !!}
                                <a href="{{ route('prodi.edit', $data->id_prodi) }}">
                                    {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'edit prodi','class' => 'btn btn-warning fa fa-pencil']) !!}
                                </a>
                                {!! Form::button('', ['type' => 'submit', 'data-toggle' => 'tooltip','data-placement' => 'top','title' => 'hapus prodi','class' => 'btn btn-danger fa fa-trash']) !!}
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