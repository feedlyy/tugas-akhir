@extends('Admin.templateAdmin')

@section('isi')
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