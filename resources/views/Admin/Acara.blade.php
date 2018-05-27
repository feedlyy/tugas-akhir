@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Acara Telah Di Tambahkan",
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
                    text: "Acara Telah Di Perbarui",
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
        <h2 style="">Daftar acara</h2>
        <a href="{{ url('admin/acara/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Acara</button></a>
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
                        @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null && \Illuminate\Support\Facades\Auth::user()->id_departemen == null && \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                            @foreach($acara as $data)
                                @if(\Carbon\Carbon::now()->timezone('Asia/Jakarta') < $data->end_date)
                            <tr>
                                <td><?php echo $i;?></td>
                                <td>{{ $data->nama_event }}</td>
                                <td><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($data->start_date)->formatLocalized('%A, %d %B %Y %H:%M')?></td>
                                <td><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($data->end_date)->formatLocalized('%A, %d %B %Y %H:%M')?></td>
                                <td>{{ $data->nama_ruangan }}</td>
                                <td>
                                    @if($data->penanggung_jawab == \Illuminate\Support\Facades\Auth::user()->username)
                                        {!! Form::open(['route' => ['acara.destroy', $data->id_acara], 'method' => 'delete', 'class' => 'hapus']) !!}
                                        <a href="{{ route('acara.edit', $data->id_acara) }}">
                                            {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'edit acara','class' => 'btn btn-warning fa fa-pencil']) !!}
                                        </a>
                                        <a href="{{ route('acara.show', $data->id_acara) }}">
                                            {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary fa fa-eye']) !!}
                                        </a>
                                        {!! Form::button('', ['type' => 'submit', 'data-toggle' => 'tooltip','data-placement' => 'top','title' => 'hapus acara','class' => 'btn btn-danger fa fa-trash']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        <a href="{{ route('acara.show', $data->id_acara) }}">
                                            {!! Form::button('Show', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary']) !!}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                                <?php $i++;?>
                                @endif
                            @endforeach
                        @elseif(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null && \Illuminate\Support\Facades\Auth::user()->id_departemen != null && \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                            @foreach($acara as $data)
                                @if(\Carbon\Carbon::now()->timezone('Asia/Jakarta') < $data->end_date)
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td>{{ $data->nama_event }}</td>
                                    <td><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($data->start_date)->formatLocalized('%A, %d %B %Y %H:%M')?></td>
                                    <td><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($data->end_date)->formatLocalized('%A, %d %B %Y %H:%M')?></td>
                                    <td>{{ $data->nama_ruangan }}</td>
                                    <td>
                                        @if($data->penanggung_jawab == \Illuminate\Support\Facades\Auth::user()->username)
                                            {!! Form::open(['route' => ['acara.destroy', $data->id_acara], 'method' => 'delete', 'class' => 'hapus']) !!}
                                            <a href="{{ route('acara.edit', $data->id_acara) }}">
                                                {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'edit acara','class' => 'btn btn-warning fa fa-pencil']) !!}
                                            </a>
                                            <a href="{{ route('acara.show', $data->id_acara) }}">
                                                {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary fa fa-eye']) !!}
                                            </a>
                                            {!! Form::button('', ['type' => 'submit', 'data-toggle' => 'tooltip','data-placement' => 'top','title' => 'hapus staf','class' => 'btn btn-danger fa fa-trash']) !!}
                                            {!! Form::close() !!}
                                        @else
                                            <a href="{{ route('acara.show', $data->id_acara) }}">
                                                {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary fa fa-eye']) !!}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++;?>
                                @endif
                            @endforeach
                                @elseif(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null && \Illuminate\Support\Facades\Auth::user()->id_departemen != null && \Illuminate\Support\Facades\Auth::user()->id_prodi != null)
                                    @foreach($acara as $data)
                                        @if(\Carbon\Carbon::now()->timezone('Asia/Jakarta') < $data->end_date)
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>{{ $data->nama_event }}</td>
                                            <td><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($data->start_date)->formatLocalized('%A, %d %B %Y %H:%M')?></td>
                                            <td><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($data->end_date)->formatLocalized('%A, %d %B %Y %H:%M')?></td>
                                            <td>{{ $data->nama_ruangan }}</td>
                                            <td>
                                                @if($data->penanggung_jawab == \Illuminate\Support\Facades\Auth::user()->username)
                                                    {!! Form::open(['route' => ['acara.destroy', $data->id_acara], 'method' => 'delete', 'class' => 'hapus']) !!}
                                                    <a href="{{ route('acara.edit', $data->id_acara) }}">
                                                        {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'edit acara','class' => 'btn btn-warning fa fa-pencil']) !!}
                                                    </a>
                                                    <a href="{{ route('acara.show', $data->id_acara) }}">
                                                        {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary fa fa-eye']) !!}
                                                    </a>
                                                    {!! Form::button('', ['type' => 'submit', 'data-toggle' => 'tooltip','data-placement' => 'top','title' => 'hapus acara','class' => 'btn btn-danger fa fa-trash']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <a href="{{ route('acara.show', $data->id_acara) }}">
                                                        {!! Form::button('', ['data-toggle' => 'tooltip','data-placement' => 'top','title' => 'lihat acara','class' => 'btn btn-primary fa fa-eye']) !!}
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                @endif
                                    @endforeach
                        @endif
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