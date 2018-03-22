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
                    text: "Tanggal mulai acara tidak boleh kurang dari hari ini",
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
                <div class="form-group">
                    <label>Datetime</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="start_date" class="form-control pull-right" id="datepicker" value="{{ $acara->start_date }}">
                    </div>

                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                {{--id gedung--}}
                <div class="form-group">
                    <label>ID Gedung</label>
                    <select class="form-control select2" id="id_gedung" style="width: 100%;" name="id_gedung" onchange="ifGedung()">
                        <option disabled selected="selected">Pilih Gedung</option>
                        @foreach($gedung as $data)
                            <option>{{ $data->id_gedung }}</option>
                        @endforeach
                    </select>
                </div>

                {{--nama ruangan--}}
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <select class="form-control select2" id="ruang" style="width: 100%;" name="nama_ruang">
                        <option disabled selected="selected">Pilih Ruangan</option>
                        @foreach($ruangan as $ruang)
                            <option id="nama_ruang">{{ $ruang->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>

                {{--tamu undangan--}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tamu Undangan</label>
                    <input type="email" name="tamu_undangan" class="form-control" id="" placeholder="" value="{{ $acara->tamu_undangan }}">
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
            $('input[name="start_date"]').daterangepicker({
                timePicker: true,
                opens: "right",
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm A'
                }
            });
        })
    </script>
@endsection