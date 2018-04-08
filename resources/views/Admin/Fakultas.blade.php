@extends('Admin.templateAdmin')

@section('isi')

    <div class="container putih">
        <h2 style="">Fakultas</h2>
        {{--<a href="{{ url('admin/acara/create') }}"><button class="fa fa-plus btn btn-primary">Tambah Acara</button></a>--}}
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table id="example1" class="table table-bordered table-striped responsive">
                    <thead>
                    <tr>
                        <th>ID Fakultas</th>
                        <th>Nama Fakultas</th>
                    </tr>
                    </thead>
                    @foreach($fakultas as $data)
                        <tr>
                            <td>{{ $data->id_fakultas }}</td>
                            <td>{{ $data->nama_fakultas }}</td>
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
        $(document).ready( function () {
            $('#example1').DataTable();
        } );
    </script>

@endsection