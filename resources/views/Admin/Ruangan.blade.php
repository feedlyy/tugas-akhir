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
                                <form method="post" action="{{ url('admin/ruangan') }}">
                                    {{ csrf_field() }}

                                    <td><a class="glyphicon glyphicon-pencil jarak" href="{{ route('ruangan.edit', $data->id_ruangan) }}"></a><a class="glyphicon glyphicon-trash"></a></td>
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