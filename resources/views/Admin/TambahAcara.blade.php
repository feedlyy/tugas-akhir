@extends('Admin.templateAdmin')

@section('isi')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{--<li>{{ $error }}</li>--}}
            <script>
                var error = "{{ $error }}";
                $().ready(function (e) {
                    swal({
                        title: "Warning!",
                        text: error,
                        icon: "warning",
                        button: false,
                        timer: 3000
                    });
                })
            </script>
        @endforeach
    @elseif(session()->has('dateError'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Tanggal mulai salah, mohon pilih kembali",
                    icon: "warning",
                    button: false,
                    timer: 3000
                });
            })
        </script>
        @elseif(session()->has('RuanganError'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Ruangan telah terdaftar, mohon pilih kembali",
                    icon: "warning",
                    button: false,
                    timer: 3000
                });
            })
        </script>
    @elseif(session()->has('EmailError'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Tamu Undangan telah terdaftar, mohon pilih kembali",
                    icon: "warning",
                    button: false,
                    timer: 3000
                });
            })
        </script>
    @elseif(session()->has('date2Error'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Tanggal mulai tidak dapat lebih dari tanggal berakhir, mohon pilih kembali",
                    icon: "warning",
                    button: false,
                    timer: 3000
                });
            })
        </script>
    @elseif(session()->has('tamuError'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Wajib mengisi tamu. Baik dari Tamu Undangan atau Staff",
                    icon: "warning",
                    button: false,
                    timer: 3000
                });
            })
        </script>
    @endif

    <!-- general form elements -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Acara</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('acara.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbsp;Kembali ke list acara</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('acara.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Nama Acara</label>
                    <input type="text" name="nama_acara" class="form-control" id="" placeholder="" value="{{ old('nama_acara') }}">
                </div>

            <!-- Date -->
                    <div class="row">
                    <div class='col-md-5'>
                        <label>Waktu Mulai</label>
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control" name="start_date" value="{{ old('start_date') }}"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>

                    </div>


                    <div class='col-md-5'>
                        <label>Waktu Berakhir</label>
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" name="end_date" value="{{ old('end_date') }}"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>

                    </div>
                    </div>
                <br>
                {{--id gedung--}}
                <div class="form-group empatlima">
                    <label>Gedung</label>
                    <select class="form-control" id="id_gedung" style="width: 100%;" name="id_gedung">
                        <option disabled selected="selected">Pilih Gedung</option>
                        @foreach($gedung as $data)
                            <option value="{{ $data->id_gedung }}">{{ $data->nama_gedung }}</option>
                            {{--<option>{{ $data->id_gedung }}</option>--}}
                        @endforeach
                    </select>
                </div>

                <div class="form-group empatlima">
                    <input type="hidden" value="" name="getgedung" id="getgedung">
                </div>

                {{--nama ruangan--}}
                <div class="form-group empatlima">
                    <label>Ruangan</label>
                    <select class="form-control" id="ruang" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                    </select>
                </div>


                <div class="row">
                    <div class="col-6 col-sm-6">
                        {{--Staff Fakultas--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Fakultas</label>
                            <select class="form-control select2 contoh" id="fakultas" multiple="multiple" name="fakultas[]">
                                <option value="vokasi">Vokasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--summary staff fakultas--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Summary Fakultas</label>
                            <select id="summary1" class="form-control select2" multiple="multiple" name="summary1[]">
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--Staff Departemen--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Departemen</label>
                            <select class="form-control select2 contoh" id="departemen" multiple="multiple" name="departemen[]">
                                <option value="dbsmb">DBMSB</option>
                                <option value="deb">DEB</option>
                                <option value="dtb">DTB</option>
                                <option value="dtm">DTM</option>
                                <option value="likes">LIKES</option>
                                <option value="sipil">SIPIL</option>
                                <option value="tedi">TEDI</option>
                                <option value="thv">THV</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--summary staff departemen--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Summary Departemen</label>
                            <select id="summary2" class="form-control select2" multiple="multiple" name="summary2[]">
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--Staff Prodi--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Prodi</label>
                            <select class="form-control select2" id="prodi" multiple="multiple" name="prodi[]">
                                <option value="agroindustri">Agroindustri</option>
                                <option value="akutansi">Akutansi</option>
                                <option value="d4 alat berat">Teknik Pengelolaan dan Perawatan Alat Berat</option>
                                <option value="d4 kebidanan">Kebidanan</option>
                                <option value="d4 sipil">Teknik Pengelolaan dan Pemeliharaan Infrastruktur Sipil</option>
                                <option value="d4 tekjar">Teknologi Rekayasa Internet</option>
                                <option value="ekonomi terapan">Ekonomi Terapan</option>
                                <option value="elektro">Teknologi Listrik</option>
                                <option value="elins">Teknologi Instrumentasi</option>
                                <option value="geomatika">Teknik Geomatika</option>
                                <option value="inggris">Bahasa Inggris</option>
                                <option value="jepang">Bahasa Jepang</option>
                                <option value="kearsipan">Kearsipan</option>
                                <option value="keswan">Kesehatan Hewan</option>
                                <option value="komsi">Ilmu Komputer dan Sistem Informasi</option>
                                <option value="korea">Bahasa Korea</option>
                                <option value="manajemen">Manajemen</option>
                                <option value="mandarin">Bahasa Mandarin</option>
                                <option value="dtm">Teknik Mesin</option>
                                <option value="metins">Metrologi dan Instrumentasi</option>
                                <option value="parwi">Kepariwisataan</option>
                                <option value="pejesig">Penginderaan Jauh dan Sistem Informasi Geografi</option>
                                <option value="pengelolaan hutan">Pengelolaan Hutan</option>
                                <option value="perancis">Bahasa Perancis</option>
                                <option value="rekmed">Rekam Medis</option>
                                <option value="sipil">Teknik Sipil</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--summary staff--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Summary Prodi</label>
                            <select id="summary3" class="form-control select2" multiple="multiple" name="summary3[]">
                            </select>
                        </div>
                    </div>
                </div>

                {{--tamu undangan--}}
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Tamu Undangan<h6>Jika lebih dari satu, pisahkan dengan enter atau koma</h6></label>
                    <select class="form-control select2" multiple="multiple" name="tamu_undangan[]">
                    </select>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            //Date picker
            $(function () {
                $('#datetimepicker6').datetimepicker({
                    format : 'MM/DD/YYYY HH:mm'
                });
                $('#datetimepicker7').datetimepicker({
                    format : 'MM/DD/YYYY HH:mm',
                    useCurrent: false //Important! See issue #1075
                });
                $("#datetimepicker6").on("dp.change", function (e) {
                    $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                });
                $("#datetimepicker7").on("dp.change", function (e) {
                    $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                });
            });

            $('#id_gedung').change(function () {
                $('#getgedung').val($('#id_gedung option:selected').text())
            });

            $(".select2").select2({
                tags: true,
                theme: "classic",
                tokenSeparators: [',', ' '],
                createTag: function (params) {
                    // Don't offset to create a tag if there is no @ symbol
                    if (params.term.indexOf('@') === -1) {
                        // Return null to disable tag creation
                        return null;
                    }

                    return {
                        id: params.term,
                        text: params.term
                    }
                }
            });

        });

        /*ini untuk ajax pemilihan ruangan agar sesuai dengan gedung nya*/
        $('#id_gedung').change(function(){

            var selected_gedung_type = $(this).val();

            $.ajax({
                url : "/nama/" + selected_gedung_type,
                type:'get',
                dataType: 'json',
                success: function(response) {


                    var $select = $('#ruang');
                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        $select.append('<option ' + response[key].nama_ruangan + '>' + response[key].nama_ruangan + '</option>'); // return empty
                    });
                }
            });
        });

        /*$('#fakultas').change(function(){


            var selected_fakultas_type = $(this).val();

            $.ajax({
                url : "/departemen/" + selected_fakultas_type,
                type:'get',
                dataType: 'json',
                success: function(response) {

                    var $select = $('#departemen');

                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        $select.append('<option ' + response[key].id_staff + '>' + response[key].email + '</option>'); // return empty
                    });
                }
            });
        });*/

        /*ini ajax untuk mendapatkan hasil query yang dikirimkan dari GetNamaController
        dengan format json_encode lalu value nya di append*/
        $('#fakultas').change(function(){

            /*mendapatkan value dari pilih staff fakultas*/
            var selected_fakultas = $(this).val();

            /*mengecek valuenya, jika value itu bukan value yang sesuai
            maka membuat object baru lagi, dimana object tersebut akan menampilkan hasil yg utuh
            tidak terdapat removedEmail*/
            if(!selected_fakultas){
                removedEmail = new Object();
                console.log(removedEmail)
            }

            $.ajax({
                url : "/getFakultas/" + selected_fakultas,
                type:'get',
                dataType: 'json',
                success: function(response) {

                    /*menjadikan inputan select2 dengan id summary1 sebagai wadahnya*/
                    var $select = $('#summary1');
                    /*lalu ketika pilihan dari fakultas di hapus, maka value yang di summary1 juga terhapus*/
                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        /*jika tidak terdapat removedEmail, maka value nya selected*/
                        if(!removedEmail[response[key].email])
                            $select.append('<option ' + response[key].id_staff + ' selected>' + response[key].email + '</option>'); // return empty
                        else
                            /*jika terdapat removedEmail, akan tetap disimpan tetapi tidak terselect*/
                            $select.append('<option ' + response[key].id_staff + '>' + response[key].email + '</option>');

                    });
                }
            });
        });

        /*get ajax departemen*/
        $('#departemen').change(function(){

            var selected_departemen = $(this).val();

            if(!selected_departemen){
                removedEmail = new Object();
                console.log(removedEmail)
            }

            $.ajax({
                url : "/getDepartemen/" + selected_departemen,
                type:'get',
                dataType: 'json',

                success: function(response) {

                    var $select = $('#summary2');
                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        if(!removedEmail[response[key].email])
                            $select.append('<option ' + response[key].id_staff + ' selected>' + response[key].email + '</option>'); // return empty
                        else
                            $select.append('<option ' + response[key].id_staff + '>' + response[key].email + '</option>');
                    });
                }
            });

        });

        /*get ajax prodi*/
        $('#prodi').change(function(){

            var selected_prodi = $(this).val();


            if(!selected_prodi){
                removedEmail = new Object();
                console.log(removedEmail)
            }

            $.ajax({
                url : "/getProdi/" + selected_prodi,
                type:'get',
                dataType: 'json',

                success: function(response) {

                    var $select = $('#summary3');
                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        if(!removedEmail[response[key].email])
                            $select.append('<option ' + response[key].id_staff + ' selected>' + response[key].email + '</option>'); // return empty
                        else
                            $select.append('<option ' + response[key].id_staff + '>' + response[key].email + '</option>');
                    });
                }
            });

        });

        /*$('#departemen').on('select2:select', function(e){
            console.log(e.params.data.id)
        });*/

        var removedEmail = {};

        $('#summary1').on('select2:unselect', function(e){
           var data = e.params.data.id;
           removedEmail[data] = data;
           console.log(removedEmail)
        });

        $('#summary2').on('select2:unselect', function(e){
            var data = e.params.data.id;
            removedEmail[data] = data;
            console.log(removedEmail)
        });

        $('#summary3').on('select2:unselect', function(e){
            var data = e.params.data.id;
            removedEmail[data] = data;
            console.log(removedEmail)
        });


        
    </script>
@endsection