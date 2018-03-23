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

                <div class="form-group">
                    <label for="exampleInputEmail1">Reminder Acara (Dalam Menit)</label>
                    <input type="number" name="reminder" class="form-control" id="" placeholder="" value="{{ old('reminder') }}">
                </div>

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
                    <input type="email" name="tamu_undangan" class="form-control" id="" placeholder="" value="{{ old('tamu_undangan') }}">
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
                    format: 'MM/DD/YYYY h:mm A'
                }
            });
        });
        
        function ifGedung() {
            var gedung = document.getElementById('id_gedung').value;
            var ruang = document.getElementById('ruang').value;
            var cek = ruang.includes(gedung);
            /*for (var i=0; i>= ruang; i++){

            }*/
            if (gedung.select){
                if (cek){
                    document.getElementById('nama_ruang').hidden = false;
                }
            } else {
                document.getElementById('nama_ruang').hidden = true;
            }

        }
        
        
    </script>
@endsection