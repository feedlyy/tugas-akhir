@extends('Admin.templateAdmin')

@section('isi')
    @if(session()->has('status'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Success!",
                    text: "Ruangan Telah Di Tambahkan!",
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
                    text: "Ruangan Telah Di Update!",
                    icon: "success",
                    button: "Done!",
                });
            })
        </script>
        @elseif(session()->has('hapus'))
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

    <div class="container putih">
        <h2 style="">List Ruangan</h2>
        <a href="{{ url('admin/ruangan/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Ruangan</button></a>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>ID Ruangan</th>
                        <th>ID Gedung</th>
                        <th>Nama Ruangan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($ruangan) > 0)
                        @foreach($ruangan as $data)
                            <tr>
                                <td>{{ $data->id_ruangan }}</td>
                                <td>{{ $data->id_gedung }} - {{ \App\Gedung::find($data->id_gedung)->nama_gedung }}</td>
                                <td>{{ $data->nama_ruangan }}</td>
                                <form method="post" action="{{ route('ruangan.destroy', $data->id_ruangan) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                    <td>
                                        <a href="{{ route('ruangan.edit', $data->id_ruangan) }}">
                                           <input type="button" class="btn btn-warning" value="Edit">
                                        </a>
                                        <input type="submit" value="Hapus" class="btn btn-danger">
                                    </td>
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