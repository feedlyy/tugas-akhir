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
                <table id="example1" class="table table-bordered table-striped responsive">
                    <thead>
                    <tr>
                        <th>ID Admin</th>
                        <th>Nama Admin</th>
                        <th>ID Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($admin as $data)
                        {{--view table di sini di bikin custom, jika yang login fakultas(id_status == 1)
                        maka tampilkan seluruh data--}}
                        @if(\Illuminate\Support\Facades\Auth::user()->id_status == 1)
                            <tr>
                                <td>{{ $data->id_admin }}</td>
                                <td>{{ $data->nama_admin }}</td>
                                <td>{{ $data->id_status }}</td>
                                <td>
                                    {{--jika ketemu dengan data yang id_status nya 1/fakultas
                                    karna dia super admin dia ga akan bisa di hapus--}}
                                    @if($data->id_status == 1)
                                    <a href="{{ route('admin.edit', $data->id_admin) }}">
                                        {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                    </a>
                                    @else
                                        {{--selain itu jika ketemu data lain maka dia bisa edit atau
                                        hapus--}}
                                        {!! Form::open(['route' => ['admin.destroy', $data->id_admin], 'method' => 'delete', 'class' => 'hapus']) !!}
                                        <a href="{{ route('admin.edit', $data->id_admin) }}">
                                            {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                        </a>
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger hapus']) !!}
                                        {!! Form::close() !!}
                                        @endif
                                </td>

                            </tr>
                            {{--custom view table ini untuk memfilter agar data yang di tampilkan di table sesuai dengan
                            departemen dan prodi dari departemen itu masing2
                            jika yang login memiliki kesamaan nama_admin yang sama dengan fungsi start_with
                            dimana start_with merupakan laravel helper yang mengecek string dengan parameter pertama
                            adalah list katanya dan parameter kedua adalah kata yang dicari--}}
                        @elseif(\Illuminate\Support\Facades\Auth::user()->nama_admin == starts_with($data->nama_admin, \Illuminate\Support\Facades\Auth::user()->nama_admin))
                        <tr>
                            <td>{{ $data->id_admin }}</td>
                            <td>{{ $data->nama_admin }}</td>
                            <td>{{ $data->id_status }}</td>
                            <td>
                                {{--otomatis kan yang login departemennya
                                departemen tidak dapat menghapus departemen itu sendiri karna bukan kebijakan
                                departemen untuk menghapus departemen, melainkan kebijakan fakultas
                                departemen hanya dapat edit/hapus prodinya saja / edit dirinya sendiri--}}
                                @if($data->id_status == 2)
                                <a href="{{ route('admin.edit', $data->id_admin) }}">
                                    {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                </a>
                                    @else
                                    {!! Form::open(['route' => ['admin.destroy', $data->id_admin], 'method' => 'delete', 'class' => 'hapus']) !!}
                                    <a href="{{ route('admin.edit', $data->id_admin) }}">
                                        {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                    </a>
                                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger hapus']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script>
        /*javascript untuk table nya*/
        $(function () {
            $('#example1').DataTable()
        })
    </script>
@endsection