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
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Acara</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('acara.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list acara</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('acara.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Acara</label>
                    <input type="text" name="nama_acara" class="form-control" id="" placeholder="" value="{{ old('nama_acara') }}">
                </div>

            <!-- Date -->
                <label>Datetime</label>
                <div class="form-group">
                    <div class='col-md-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control" name="start_date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" name="end_date"/>
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
                            <option>{{ $data->id_gedung }}</option>
                        @endforeach
                    </select>
                </div>


                {{--nama ruangan--}}
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <select class="form-control" id="ruang" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                    </select>
                </div>

                {{--tamu undangan--}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tamu Undangan</label>
                    <select class="form-control select2" multiple="multiple" name="tamu_undangan[]">
                        <option></option>
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
        
        
    </script>
@endsection