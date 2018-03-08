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
                    <input type="text" name="nama_event" class="form-control" id="" placeholder="">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Acara</label>
                    <input type="text" name="tanggal" class="form-control" id="" placeholder="">
                </div>
            </div>

            <div class="box-body">
                <!-- Date and time range -->
                <div class="form-group">
                    <label>Date and time range:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        {{--<input type="text" class="form-control pull-right" id="reservationtime">--}}
                        <input type="text" class="form-control" name="daterange" value="" />
                    </div>
                    <!-- /.input group -->
                </div>
            </div>

            <!-- /.form group -->
            {{--<div class="box-body">
                <div class="form-group">
                    <label>ID Status</label>
                    <select class="form-control select2" style="width: 100%;" name="selectstatus">
                        @foreach($status as $data)
                            <option selected="selected">{{ $data->id_status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>--}}

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
    </script>
@endsection