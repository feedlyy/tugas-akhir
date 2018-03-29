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
        @elseif(session()->has('dateTimeError'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Acara/Ruangan telah terdaftar, mohon pilih kembali",
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
                <div class="form-group">
                    <label>Datetime</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="start_date" class="form-control pull-right" id="datepicker" value="{{ old('start_date') }}">
                    </div>

                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                {{--<div class="form-group">
                    <label for="exampleInputEmail1">Reminder Acara (Dalam Menit)</label>
                    --}}{{--<input type="number" name="reminder" class="form-control" id="" placeholder="" value="{{ old('reminder') }}">--}}{{--
                    <select class="form-control" id="reminder" multiple="multiple" name="reminder[]">
                        <option></option>
                    </select>
                </div>--}}

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
            $('input[name="start_date"]').daterangepicker({
                timePicker: true,
                opens: "right",
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm'
                }
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