@extends('Admin.templateAdmin')

@section('isi')

    {{--<link rel="stylesheet" href="{{ url('fonts/glyphicons-halflings-regular.woff') }}">--}}




    <div class="container putih">
        <h2 style="">List Gedung</h2>
        @auth
            @if(Auth::user()->id_status == 1)
                <a href="{{ route('tambahGedung1') }}"><button class="button btn-success fa fa-plus-circle">Tambah Gedung</button></a>
            @endif
        @endauth
        <div class="row" style="margin-top: 3%;">
            <div class="col-xs-12" id="table">
                <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>Country</th>
                        <th>Languages</th>
                        <th>Population</th>
                        <th>Median Age</th>
                        <th>Area (Km²)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Argentina</td>
                        <td>Spanish (official), English, Italian, German, French</td>
                        <td>41,803,125</td>
                        <td>31.3</td>
                        <td>2,780,387</td>
                    </tr>
                    <tr>
                        <td>Australia</td>
                        <td>English 79%, native and other languages</td>
                        <td>23,630,169</td>
                        <td>37.3</td>
                        <td>7,739,983</td>
                    </tr>
                    <tr>
                        <td>Greece</td>
                        <td>Greek 99% (official), English, French</td>
                        <td>11,128,404</td>
                        <td>43.2</td>
                        <td>131,956</td>
                    </tr>
                    <tr>
                        <td>Luxembourg</td>
                        <td>Luxermbourgish (national) French, German (both administrative)</td>
                        <td>536,761</td>
                        <td>39.1</td>
                        <td>2,586</td>
                    </tr>
                    <tr>
                        <td>Russia</td>
                        <td>Russian, others</td>
                        <td>142,467,651</td>
                        <td>38.4</td>
                        <td>17,076,310</td>
                    </tr>
                    <tr>
                        <td>Sweden</td>
                        <td>Swedish, small Sami- and Finnish-speaking minorities</td>
                        <td>9,631,261</td>
                        <td>41.1</td>
                        <td>449,954</td>
                    </tr>
                    </tbody>
                    {{--<tfoot>--}}
                    {{--<tr>--}}
                        {{--<td colspan="5" class="text-center">Data retrieved from <a href="http://www.infoplease.com/ipa/A0855611.html" target="_blank">infoplease</a> and <a href="http://www.worldometers.info/world-population/population-by-country/" target="_blank">worldometers</a>.</td>--}}
                    {{--</tr>--}}
                    {{--</tfoot>--}}
                </table>
            </div>
        </div>
    </div>

    {{--<script src="{{ url('dataTables/js/jquery.min.js') }}"></script>--}}


    <script>
        $('table').DataTable();
    </script>
@endsection