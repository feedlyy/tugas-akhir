@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Admin Telah Di Tambahkan",
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
                    text: "Admin Telah Di Perbarui",
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
                    text: "Admin Telah Di Hapus",
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
        <h2 style="">List Admin</h2>
        <a href="{{ url('admin/admin/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Admin</button></a>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>ID Admin</th>
                        <th>Nama Admin</th>
                        <th>ID Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admin as $data)
                        <tr>
                            <td>{{ $data->id_admin }}</td>
                            <td>{{ $data->nama_admin }}</td>
                            <td>{{ $data->id_status }}</td>
                            <td>
                                {!! Form::open(['route' => ['admin.destroy', $data->id_admin], 'method' => 'delete', 'class' => 'hapus']) !!}
                                <a href="{{ route('admin.edit', $data->id_admin) }}">
                                    {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                </a>
                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger hapus']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <script>
        $('table').DataTable();
    </script>
@endsection