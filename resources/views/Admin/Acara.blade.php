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
        <h2 style="">List acara {{\Illuminate\Support\Facades\Auth::user()->nama_admin}}</h2>
        <a href="{{ url('admin/acara/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Acara</button></a>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                    <table id="example1" class="table table-bordered table-striped responsive">
                        <thead>
                        <tr>
                            <th>ID Acara</th>
                            <th>Nama Acara</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($acara as $data)
                            @if(\Illuminate\Support\Facades\Auth::user()->id_status == 1)
                                <tr>
                                    <td>{{ $data->id_acara }}</td>
                                    <td>{{ $data->nama_event }}</td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>{{ $data->alarm }}</td>
                                    <td>
                                        @if($data->penanggung_jawab == 1)
                                        {!! Form::open(['route' => ['acara.destroy', $data->id_acara], 'method' => 'delete', 'class' => 'hapus']) !!}
                                        <a href="{{ route('acara.edit', $data->id_acara) }}">
                                            {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                        </a>
                                        <a href="{{ route('acara.show', $data->id_acara) }}">
                                            {!! Form::button('Show', ['class' => 'btn btn-primary']) !!}
                                        </a>
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        @else
                                            <a href="{{ route('acara.show', $data->id_acara) }}">
                                                {!! Form::button('Show', ['class' => 'btn btn-primary']) !!}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                                @foreach($query as $data)
                                <tr>
                                    <td>{{ $data->id_acara }}</td>
                                    <td>{{ $data->nama_event }}</td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>{{ $data->alarm }}</td>
                                    <td>
                                        @if($data->penanggung_jawab == \Illuminate\Support\Facades\Auth::user()->id_admin)
                                        {!! Form::open(['route' => ['acara.destroy', $data->id_acara], 'method' => 'delete', 'class' => 'hapus']) !!}
                                        <a href="{{ route('acara.edit', $data->id_acara) }}">
                                            {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                        </a>
                                        <a href="{{ route('acara.show', $data->id_acara) }}">
                                            {!! Form::button('Show', ['class' => 'btn btn-primary']) !!}
                                        </a>
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        @else
                                            <a href="{{ route('acara.show', $data->id_acara) }}">
                                                {!! Form::button('Show', ['class' => 'btn btn-primary']) !!}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach


                    </table>
            </div>
        </div>
    </div>
    <div>

    </div>

    <script>
        /*javascript untuk table nya*/
        $(function () {
            $('#example1').DataTable({

            })
        })
    </script>
@endsection