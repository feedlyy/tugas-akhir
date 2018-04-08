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
    @elseif(session()->has('alr_exist'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Data sudah ada",
                    icon: "warning",
                    button: false,
                    timer: 2000
                });
            })
        </script>
    @endif

    <!-- general form elements -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Admin</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('admin.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list admin</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Admin</label>
                    <input type="text" name="nama_admin" class="form-control" id="" placeholder="" value="{{ old('nama_admin') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label>ID Status</label>
                    @if(\Illuminate\Support\Facades\Auth::user()->id_status == 1)
                    <select id="status" class="form-control select2" style="width: 100%;" name="selectstatus" onchange="ifProdi()">
                        <option disabled selected="selected">Pilih Status</option>
                        @foreach($status as $data)
                            @if($data->id_status == 1)
                                <option hidden>{{ $data->id_status}}</option>
                            @else
                            <option value="{{ $data->id_status }}">{{ $data->id_status }}</option>
                            @endif
                        @endforeach
                    </select>
                    @elseif(\Illuminate\Support\Facades\Auth::user()->id_status == 2)
                        <select class="form-control select2" style="width: 100%;" name="selectstatus">
                            <option disabled selected="selected">Pilih Status</option>
                            @foreach($status as $data)
                                @if($data->id_status == 1 || $data->id_status == 2)
                                    <option hidden>{{ $data->id_status}}</option>
                                @else
                                <option>{{ $data->id_status }}</option>
                                @endif
                            @endforeach
                        </select>
                    @endif
                    <h6>1 = Fakultas, 2 = Departemen, 3 = Prodi</h6>
                </div>
                <div class="form-group">
                    <label>Pilih Departemen (Jika Tambah Prodi)</label>
                        <select id="departemen" class="form-control select2" style="width: 100%;" name="selectdepartemen" disabled>
                            <option disabled selected="selected">Pilih Departemen</option>
                            @foreach($admin as $data)
                                @if($data->id_status == 2)
                                <option value="{{ $data->id_admin }}">{{ $data->nama_admin }}</option>
                                    @else
                                @endif
                            @endforeach
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
            /*fungsi javascript
            jika value pada select status = 3 (prodi) maka
            inputan select departemen yang tadi nya disabled akan diubah menjadi false
            selain value = 3 maka select departemen akan disabled(true)*/
            function ifProdi() {
                if (document.getElementById('status').value == 3){
                    document.getElementById('departemen').disabled = false;
                } else {
                    document.getElementById('departemen').disabled = true;
                }
            }

    </script>
@endsection