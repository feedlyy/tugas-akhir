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
    @elseif(session()->has('import'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Data Berhasil Di Import",
                    icon: "success",
                    button: false,
                    timer: 2000
                });
            })
        </script>
    @elseif(session()->has('gagal'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Data Gagal Di Import",
                    icon: "warning",
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
        {{--<a href="{{ url('admin/staff/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Staff</button></a>--}}
        <a href="{{ url('admin/ExportExcel') }}" class="fa fa-plus btn btn-adn">Export Excel</a>
        <button data-toggle="modal" data-target="#modal-default" class="fa fa-plus btn btn-success">Import Excel</button>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Staff</th>
                        {{--<th>ID Status</th>--}}
                        <th>NIP</th>
                        <th>Nama Staff</th>
                        {{--<th>Email</th>
                        <th>Alamat</th>
                        <th>No Hp</th>--}}
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;?>
                        @foreach($staff as $data)
                            <tr>
                                <td><?php echo $i;?></td>
                                {{--<td>{{ $data->id_status }}</td>--}}
                                <td>{{ $data->nip }}</td>
                                <td>{{ $data->nama_staff }}</td>
                                {{--<td>{{ $data->email }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->no_hp }}</td>--}}
                                <td>
                                    {!! Form::open(['route' => ['staff.destroy', $data->id_staff ], 'method' => 'delete', 'class' => 'hapus']) !!}
                                    <a href="{{ route('staff.edit', $data->id_staff ) }}">
                                        {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                    </a>
                                    <a href="{{ route('staff.show', $data->id_staff) }}">
                                        {!! Form::button('', ['class' => 'btn btn-primary fa fa-eye']) !!}
                                    </a>
                                    {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger fa fa-trash']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <?php $i++;?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{--<form method="post" action="{{ url('admin/importExcel') }}" enctype="multipart/form-data">--}}
        {!! Form::open(array('url' => 'admin/importExcel', 'method' => 'POST', 'files' => 'true')) !!}
            {{ csrf_field() }}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Import Excel</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label>Format Excel</label>
                            <img class="img-responsive" src="{{ url('image/1.png') }}">
                        </div>
                        {{--inputan disini hanya menerima bentukan .xlsx, .xls, .csv--}}
                        {{--<input name="file" type="file" accept="" ID="fileSelect" runat="server" />--}}
                        {!! Form::file('file', array('class' => 'form-control', 'accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel')) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        {!! Form::submit('Import', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {!! Form::close() !!}
        {{--</form>--}}
        <!-- /.modal -->
    </div>


    <script>
        /*javascript untuk table nya*/
        $(document).ready( function () {
            $('#example1').DataTable();
        } );
    </script>
@endsection