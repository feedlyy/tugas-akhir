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
                        button: "OK",
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
    @endif

    <!-- general form elements -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Acara</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('acara.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list acara</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('acara.update', $acara->id_acara) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Nama Acara</label>
                        <input type="text" name="nama_acara" class="form-control" id="" placeholder="" value="{{ $acara->nama_event }}">
                </div>

                <!-- Date -->

                <div class="row">
                    <div class='col-md-5'>
                        <label>Waktu Mulai</label>
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' value="{{ $acara->start_date }}" class="form-control" name="start_date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>

                    </div>
                    <div class='col-md-5'>
                        <label>Waktu Berakhir</label>
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' value="{{ $acara->end_date }}" class="form-control" name="end_date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>

                    </div>
                </div>
                <!-- /.form group -->
                <br>
                {{--id gedung--}}
                <div class="form-group empatlima">
                    <label>ID Gedung</label>
                    <select class="form-control" id="id_gedung" style="width: 100%;" name="id_gedung">
                        <option disabled selected="selected">Pilih Gedung</option>
                        @foreach($gedung as $data)
                            <option value="{{ $data->id_gedung }}" <?php if($data->id_gedung == $acara->id_gedung){echo "selected";} ?>
                            >{{ $data->nama_gedung }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="width: 150% !important;">
                    <input type="hidden" value="{{ $gedung[0]['nama_gedung'] }}" name="getgedung" id="getgedung">
                </div>

                {{--<div class="form-group">
                    <label>Ruangan Sebelumnya</label>
                    <input value="{{ $acara->nama_ruangan }}" disabled>
                </div>--}}
                {{--nama ruangan--}}
                <div class="form-group empatlima">
                    <label>Nama Ruangan</label>
                    <select class="form-control" id="ruang" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                        @foreach($ruangan as $data)
                            <option <?php if($data->nama_ruangan = $acara->nama_ruangan){echo "selected";} ?>
                            ></option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-6 col-sm-6">
                        {{--Staff Fakultas--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Fakultas</label>
                            <select class="form-control select2 contoh" id="fakultas" multiple="multiple" name="fakultas[]">
                                @foreach($tampungFakultas as $key => $value)
                                    @if($value == 'selected')
                                        <option value="{{ $key }}" selected>{{ $key }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--summary staff fakultas--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Summary Fakultas</label>
                            <select id="summary1" class="form-control select2" multiple="multiple" name="summary1[]">
                                @foreach($fakultas as $key)
                                    <option value="{{ $key->email }}" selected>{{ $key->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--Staff Departemen--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Departemen</label>
                            <select class="form-control select2 contoh" id="departemen" multiple="multiple" name="departemen[]">
                                @foreach($tampungDepartemen as $key => $value)
                                    @if($value == 'selected')
                                        <option value="{{ $key }}" selected>{{ $key }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--summary staff departemen--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Summary Departemen</label>
                            <select id="summary2" class="form-control select2" multiple="multiple" name="summary2[]">
                                @foreach($departemen as $key)
                                    <option value="{{ $key->email }}" selected>{{ $key->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--Staff Prodi--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Prodi</label>
                            <select class="form-control select2" id="prodi" multiple="multiple" name="prodi[]">
                                @foreach($tampungProdi as $key => $value)
                                    @if($value == 'selected')
                                        <option value="{{ $key }}" selected>{{ $key }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6">
                        {{--summary staff--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Summary Prodi</label>
                            <select id="summary3" class="form-control select2" multiple="multiple" name="summary3[]">
                                @foreach($prodi as $key)
                                    <option value="{{ $key->email }}" selected>{{ $key->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{--tamu undangan--}}
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Tamu Undangan<h6>Jika lebih dari satu, pisahkan dengan enter atau koma</h6></label>
                    <select class="form-control select2" multiple="multiple" name="tamu_undangan[]">
                        @foreach($tamu as $key)
                            <option value="{{ $key->email }}" selected>{{ $key->email }}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>
    <script>
        $(function () {
            //Date picker
            $(function () {
                $('#datetimepicker6').datetimepicker({
                    format : 'MM/DD/YYYY HH:mm',
                    /*ini untuk get value dari db*/
                    date: new Date("{{ $acara->start_date }}")
                });
                $('#datetimepicker7').datetimepicker({
                    format : 'MM/DD/YYYY HH:mm',
                    /*ini untuk get value dari db*/
                    date: new Date("{{ $acara->end_date }}"),
                    useCurrent: false //Important! See issue #1075
                });
                $("#datetimepicker6").on("dp.change", function (e) {
                    $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                });
                $("#datetimepicker7").on("dp.change", function (e) {
                    $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                });
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


        $('#id_gedung').change(function(){
            var selected_gedung_type = $(this).val();

            $.ajax({
                url : "/nama/" + selected_gedung_type,
                type:'get',
                dataType: 'json',
                success: function(response) {
                    //alert(response); // show [object, Object]

                    var $select = $('#ruang');

                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        $select.append('<option ' + response[key].nama_ruangan + '>' + response[key].nama_ruangan + '</option>'); // return empty

                    });
                }
            });
        });

        $(document).ready(function(){
            var selected_gedung_type = $('#id_gedung').val();

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