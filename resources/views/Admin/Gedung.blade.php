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
                <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>ID Gedung</th>
                        <th>Nama Gedung</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($gedung as $data)
                            <tr>
                                {{--ini cara kalau mau liat detail per id nya--}}
                                {{--<td><a href="{{ route('gedung.show', $data->id_gedung) }}">{{ $data->id_gedung }}</td></a>--}}
                                <td>{{ $data->id_gedung }}</td>
                                <td>{{ $data->nama_gedung }}</td>
                                <td>
                                    {!! Form::open(['route' => ['gedung.destroy', $data->id_gedung], 'method' => 'delete', 'class' => 'hapus']) !!}
                                    <a href="{{ route('gedung.edit', $data->id_gedung) }}">
                                        {!! Form::button('Edit', ['class' => 'btn btn-warning']) !!}
                                    </a>
                                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger hapus']) !!}
                                    {!! Form::close() !!}
                                </td>
                                {{--<form method="post" action="{{ route('gedung.destroy', $data->id_gedung ) }}">
                                    --}}{{--disini kenapa route nya ke hapus/destroy? karna
                                    tombol hapus yang format nya input dan type nya submit buat langsung memproses delete nya
                                    kalau pake href nanti cuma nge-link aja ga bakal nge hapus. html juga ga bisa definisiin method yang dipake
                                    dan bisa di liat di php artisan route:list
                                    disitu tertulis kalau mau hapus pake method delete
                                    makanya disini dikasih input type hidden dengan nama method dan value DELETE
                                    atau bisa pake method field--}}{{--
                                    --}}{{--<input type="hidden" name="_method" value="DELETE">--}}{{--
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <input class="btn btn-danger" type="submit" value="Hapus"></a>
                                </form>--}}

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