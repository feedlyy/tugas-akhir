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
                        timer: 2000
                    });
                })
            </script>
        @endforeach
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
                    <input type="text" name="nama_acara" class="form-control" id="" placeholder="">
                </div>

                <!-- Date and time range -->
                <div class="form-group">
                    <label>Detail Acara</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        {{--<input type="text" class="form-control pull-right" id="reservationtime">--}}
                        <input type="text" class="form-control" name="daterange" value="" />
                    </div>
                    <!-- /.input group -->
                </div>

            <!-- time Picker -->
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Reminder (Sebelum Acara)</label>

                        <div class="input-group">
                            <input type="text" name="reminder" class="form-control timepicker">

                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>

                {{--nama ruangan--}}
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <select class="form-control select2" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                        @foreach($ruangan as $ruang)
                            <option>{{ $ruang->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>

                {{--tamu undangan--}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tamu Undangan</label>
                    <input type="email" name="tamu_undangan" class="form-control" id="" placeholder="">
                </div>

                {{--id admin--}}
                {{--<div class="form-group">
                    <label>Nama Ruangan</label>
                    <select class="form-control select2" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                        @foreach($ruangan as $ruang)
                            <option>{{ $ruang->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>--}}
                {{--penutup box body--}}
            </div>


            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script>
        /*untuk daterangepicker*/
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm A'
                }
            });
        });

        /*untuk timepicker*/
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    </script>
@endsection