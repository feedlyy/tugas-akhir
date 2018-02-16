@extends('Admin.templateAdmin')

@section('isi')

    {{--<link rel="stylesheet" href="{{ url('fonts/glyphicons-halflings-regular.woff') }}">--}}




    <div class="container putih">
        <h2 style="">List Gedung</h2>
        <button class="fa fa-plus btn btn-primary">Tambah Gedung</button>
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
                        {{--<td>English 79%, native and other languages</td>--}}
                        {{--<td>asd</td>--}}
                        @foreach($gedung as $data)
                            <tr>
                                <td>{{ $data->id_gedung }}</td>
                                <td>{{ $data->nama_gedung }}</td>
                                <form method="post" action="{{ url('admin/gedung') }}">
                                    {{ csrf_field() }}

                                    <td><a class="glyphicon glyphicon-pencil jarak"></a><a class="glyphicon glyphicon-trash"></a></td>
                                </form>
                            </tr>
                        @endforeach
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