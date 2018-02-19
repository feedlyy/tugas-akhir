@extends('Admin.templateAdmin')

@section('isi')


    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
        @elseif(session()->has('update'))
        <div class="alert alert-success">
            {{ session()->get('update') }}
        </div>
    @endif



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
                                <form method="post" action="{{ url('admin/gedung') }}">
                                    {{ csrf_field() }}

                                    <td><a class="glyphicon glyphicon-pencil jarak" href="{{ route('gedung.edit', $data->id_gedung) }}"></a><a class="glyphicon glyphicon-trash"></a></td>
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