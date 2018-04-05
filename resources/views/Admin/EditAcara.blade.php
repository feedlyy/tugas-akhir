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
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
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
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Acara</label>
                        <input type="text" name="nama_acara" class="form-control" id="" placeholder="" value="{{ $acara->nama_event }}">
                </div>

                <!-- Date -->
                <label>Datetime</label>
                <div class="form-group">
                    <div class='col-md-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' value="{{ $acara->start_date }}" class="form-control" name="start_date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' value="{{ $acara->end_date }}" class="form-control" name="end_date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->
                <br>
                <br>

                {{--id gedung--}}
                <div class="form-group">
                    <label>ID Gedung</label>
                    <select class="form-control" id="id_gedung" style="width: 100%;" name="id_gedung" onchange="ifGedung()">
                        <option disabled selected="selected">Pilih Gedung</option>
                        @foreach($gedung as $data)
                            <option <?php if($data->id_gedung == $acara->id_gedung){echo "selected";} ?>
                            >{{ $data->id_gedung }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ruangan Sebelumnya</label>
                    <input value="{{ $acara->nama_ruangan }}" disabled>
                </div>
                {{--nama ruangan--}}
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <select class="form-control" id="ruang" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                        @foreach($ruangan as $data)
                            <option <?php if($data->nama_ruangan = $acara->nama_ruangan){echo "selected";} ?> id="a"
                            ></option>
                        @endforeach
                    </select>
                </div>

                {{--tamu undangan--}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tamu Undangan</label>
                    <select id="select" class="form-control select2" multiple="multiple" name="tamu_undangan[]">
                        {{--<option></option>--}}
                        @foreach($tamu as $key)
                            <option value="{{ $key->email }}" selected>{{ $key->email }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="col-md-4" id="cekVokasi">
                        {!! Form::label('Staff Vokasi') !!}
                        &nbsp
                        {!! Form::checkbox('vokasi', $string) !!}
                    </div>
                <div class="col-md-4">
                    {!! Form::label('Staff Departemen '.ucfirst(\Illuminate\Support\Facades\Auth::user()->nama_admin)) !!}
                    &nbsp
                    {!! Form::checkbox('departemen', '') !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('Staff Prodi '.ucfirst(\Illuminate\Support\Facades\Auth::user()->nama_admin)) !!}
                    &nbsp
                    {!! Form::checkbox('prodi', 'value nya masukin disini') !!}
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


        $(".select2").select2({
            tags: true,
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
        
        /*$(document).ready(function () {
            if (("vokasi").val() == ("#select").val())
            {
                $("#cekVokasi").hide();
            }
        });*/
    </script>
@endsection