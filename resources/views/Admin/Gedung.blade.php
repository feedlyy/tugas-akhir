@extends('Admin.templateAdmin')

@section('isi')


    @if(session()->has('status'))
        {{--<div class="alert alert-success">--}}
            {{--{{ session()->get('status') }}--}}
        {{--</div>--}}
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Gedung Telah Di Tambahkan!",
                    icon: "success",
                    button: "Done!",
                });
            })
        </script>
        @elseif(session()->has('update'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Gedung Telah Di Update!",
                    icon: "success",
                    button: "Done!",
                });
            })
        </script>
        @elseif(session()->has('hapus'))
        {{--ini script buat delete confirmation--}}
        <script>

            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Gedung Telah Di Hapus!",
                    icon: "success",
                    button: "Done!",
                });
            })

        </script>
    @endif
    {{--<script>
        function confirm() {
            $().ready(function (e) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
            }
            });
            })

        }
    </script>--}}



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
                        @if(count($gedung) > 0)
                        @foreach($gedung as $data)
                            <tr>
                                {{--ini cara kalau mau liat detail per id nya--}}
                                {{--<td><a href="{{ route('gedung.show', $data->id_gedung) }}">{{ $data->id_gedung }}</td></a>--}}
                                <td>{{ $data->id_gedung }}</td>
                                <td>{{ $data->nama_gedung }}</td>
                                <td>
                                    <a href="{{ route('gedung.edit', $data->id_gedung) }}">
                                        <input type="button" class="btn btn-warning" value="Edit">
                                    </a>
                                    {{--<a class="glyphicon glyphicon-trash" id="hapus"></a>--}}
                                    <a><input class="btn btn-danger" type="submit" value="Hapus"></a>
                                </td>
                                <form method="post" action="{{ route('gedung.destroy', $data->id_gedung ) }}">
                                    {{--disini kenapa route nya ke hapus/destroy? karna
                                    tombol hapus yang format nya input dan type nya submit buat langsung memproses delete nya
                                    kalau pake href nanti cuma nge-link aja ga bakal nge hapus
                                    dan bisa di liat di php artisan route:list
                                    disitu tertulis kalau mau hapus pake method delete
                                    makanya disini dikasih input type hidden dengan nama method dan value DELETE--}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}

                                </form>
                            </tr>
                        @endforeach
                            @else
                        <p>Tidak ada data</p>
                            @endif
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