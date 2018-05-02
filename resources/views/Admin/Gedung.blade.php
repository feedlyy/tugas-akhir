@extends('Admin.templateAdmin')

@section('isi')


    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Gedung Telah Di Tambahkan",
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
                    text: "Gedung Telah Di Perbarui",
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
                    text: "Gedung Telah Di Hapus",
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
        <h2 style="">List Gedung</h2>
        <a href="{{ url('admin/gedung/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Gedung</button></a>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Gedung</th>
                        <th>Nama Gedung</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php $i = 1;?>
                    @foreach($gedung as $data)
                        <tr>
                            {{--ini cara kalau mau liat detail per id nya--}}
                            {{--<td><a href="{{ route('gedung.show', $data->id_gedung) }}">{{ $data->id_gedung }}</td></a>--}}
                            <td><?php echo $i?></td>
                            <td>{{ $data->id_gedung }}</td>
                            <td>{{ $data->nama_gedung }}</td>
                            <td>
                                {!! Form::open(['route' => ['gedung.destroy', $data->id_gedung], 'method' => 'delete', 'class' => 'hapus']) !!}
                                <a href="{{ route('gedung.edit', $data->id_gedung) }}">
                                    {!! Form::button('', ['class' => 'btn btn-warning fa fa-pencil']) !!}
                                </a>
                                {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger fa fa-trash']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <?php $i++?>
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