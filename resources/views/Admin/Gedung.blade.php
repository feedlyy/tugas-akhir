@extends('Admin.templateAdmin')

@section('isi')

    {{--<link rel="stylesheet" href="{{ url('fonts/glyphicons-halflings-regular.woff') }}">--}}




    <div class="container putih">
        <h2 style="">List Gedung</h2>
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>ID Gedung</th>
                        <th>Nama Gedung</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        {{--<td>Argentina</td>--}}
                        {{--<td>Spanish (official), English, Italian, German, French</td>--}}
                        <td>
                            {{--{{ $gedung = App\Gedung::all()}}--}}
                            {{--{{ $idgedung = $gedung->id_gedung }}--}}
                            {{--@foreach($idgedung as $gedung)--}}
                                {{--echo $gedung;--}}
                            {{--@endforeach--}}
                        asdasd
                        </td>
                        <td>asd</td>
                    </tr>
                    <tr>
                        <td>English 79%, native and other languages</td>
                        <td>asd</td>
                    </tr>
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