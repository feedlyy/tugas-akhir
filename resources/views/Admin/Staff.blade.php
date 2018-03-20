@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Staff Telah Di Tambahkan!",
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
                    text: "Staff Telah Di Update!",
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
                    text: "Staff Telah Di Hapus!",
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
        <h2 style="">List Staff</h2>
        <a href="{{ url('admin/staff/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Staff</button></a>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>ID Staff</th>
                        {{--<th>ID Status</th>
                        <th>NIP</th>--}}
                        <th>Nama Staff</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $data)
                            <tr>
                                <td>{{ $data->id_staff }}</td>
                                {{--<td>{{ $data->id_status }}</td>
                                <td>{{ $data->nip }}</td>--}}
                                <td>{{ $data->nama_staff }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    {!! Form::open(['route' => ['staff.destroy', $data->id_staff ], 'method' => 'delete', 'class' => 'hapus']) !!}
                                    <a href="{{ route('staff.edit', $data->id_staff ) }}">
                                        {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                    </a>
                                    <a href="{{ route('staff.show', $data->id_staff) }}">
                                        {!! Form::button('Show', ['class' => 'btn btn-primary']) !!}
                                    </a>
                                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--<script src="{{ url('dataTables/js/jquery.min.js') }}"></script>--}}


    <script>
        $('table').DataTable();
    </script>
@endsection