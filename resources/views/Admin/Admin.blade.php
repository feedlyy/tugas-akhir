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
        @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
        \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
        \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
            <a href="{{ url('admin/admin/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Admin Prodi</button></a>
            <a href="{{ url('admin/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Admin Departemen</button></a>
        @else
            <a href="{{ url('admin/admin/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Admin Prodi</button></a>
        @endif

        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped responsive">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php $i = 1;?>
                    @foreach($admin as $data)
                        {{--view table di sini di bikin custom, jika yang login fakultas
                        maka tampilkan seluruh data--}}
                        @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
                        \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
                        \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                            <tr>
                                <td><?php echo $i;?></td>
                                <td>{{ $data->username }}</td>
                                <td>
                                    {{--jika ada admin fakultas maka tidak dapat dihapus--}}
                                    @if($data->id_fakultas != null && $data->id_departemen == null && $data->id_prodi == null)
                                    <a href="{{ route('admin.edit', $data->id_admin) }}">
                                        {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                    </a>
                                    @else
                                        {{--selain itu jika ketemu data lain maka dia bisa edit atau
                                        hapus--}}
                                        {!! Form::open(['route' => ['admin.destroy', $data->id_admin], 'method' => 'delete', 'class' => 'hapus']) !!}
                                        <a href="{{ route('admin.edit', $data->id_admin) }}">
                                            {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                        </a>
                                        {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger fa fa-trash']) !!}
                                        {!! Form::close() !!}
                                        @endif
                                </td>

                            </tr>
                            {{--ketika admin departemen yang masuk--}}
                        @elseif($data->id_departemen == \Illuminate\Support\Facades\Auth::user()->id_departemen)
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>{{ $data->username }}</td>
                            <td>
                                {{--otomatis kan yang login departemennya
                                departemen tidak dapat menghapus departemen itu sendiri karna bukan kebijakan
                                departemen untuk menghapus departemen, melainkan kebijakan fakultas
                                departemen hanya dapat edit/hapus prodinya saja / edit dirinya sendiri--}}
                                @if($data->id_fakultas != null && $data->id_departemen != null && $data->id_prodi == null)
                                <a href="{{ route('admin.edit', $data->id_admin) }}">
                                    {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                </a>
                                    @else
                                    {!! Form::open(['route' => ['admin.destroy', $data->id_admin], 'method' => 'delete', 'class' => 'hapus']) !!}
                                    <a href="{{ route('admin.edit', $data->id_admin) }}">
                                        {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                    </a>
                                    {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger fa fa-trash']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endif
                        <?php $i++;?>
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