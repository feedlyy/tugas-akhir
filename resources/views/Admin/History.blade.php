@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('hapus'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Acara Telah Di Hapus",
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
        <h2>History Acara</h2>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Acara</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Berakhir</th>
                        <th>Tempat</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php $i = 1?>
                    @foreach($history as $data)
                        @if(\Carbon\Carbon::now()->timezone('Asia/Jakarta') > $data->end_date)
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>{{ $data->nama_event }}</td>
                            <td>{{ $data->start_date }}</td>
                            <td>{{ $data->end_date }}</td>
                            <td>{{ $data->nama_ruangan }}</td>
                            <td>
                                {!! Form::open(['route' => ['hapushistory', $data->id_acara], 'method' => 'delete', 'class' => 'hapus']) !!}
                                <a href="{{ route('acara.show', $data->id_acara) }}">
                                    {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary fa fa-eye']) !!}
                                </a>
                                {!! Form::button('', ['type' => 'submit', 'data-toggle' => 'tooltip','data-placement' => 'top','title' => 'hapus acara','class' => 'btn btn-danger fa fa-trash']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                            <?php $i++;?>
                        @endif
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