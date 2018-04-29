@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Ruangan Telah Di Tambahkan!",
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
                    text: "Ruangan Telah Di Update!",
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
                    text: "Ruangan Telah Di Hapus!",
                    icon: "success",
                    button: false,
                    timer: 2000
                });
            })
        </script>

    @endif

    <script>
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
        <h2 style="">List Ruangan</h2>
        <a href="{{ url('admin/ruangan/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Ruangan</button></a>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Ruangan</th>
                        <th>ID Gedung</th>
                        <th>Nama Ruangan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($ruangan as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->id_ruangan }}</td>
                            <td>{{ $data->id_gedung }} - {{ \App\Gedung::find($data->id_gedung)->nama_gedung }}</td>
                            <td>{{ $data->nama_ruangan }}</td>
                            <td>
                                {!! Form::open(['route' => ['ruangan.destroy', $data->id], 'method' => 'delete', 'class' => 'hapus']) !!}
                                <a href="{{ route('ruangan.edit', $data->id) }}">
                                    {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                </a>
                                {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger fa fa-trash']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script>
        /*javascript untuk table nya*/
        $(function () {
            $('#example1').DataTable({

            })
        })
    </script>
@endsection