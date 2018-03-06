@extends('Admin.templateAdmin')

@section('isi')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
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
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Staff</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('staff.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list staff</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('staff.store') }}">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label>ID Status</label>
                    <select class="form-control select2" style="width: 100%;" name="id_status">
                        <option disabled selected="selected">Pilih Status</option>
                        @foreach($status as $data)
                            <option>{{ $data->id_status }}</option>
                        @endforeach
                    </select>
                    <h6>1 = Fakultas, 2 = Departemen, 3 = Prodi</h6>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" id="" placeholder="" autofocus required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Staff</label>
                    <input type="text" name="nama_staff" class="form-control" value="{{ old('nama_staff') }}" id="" placeholder="" autofocus required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email_staff" class="form-control" value="{{ old('email_staff') }}" id="" placeholder="" autofocus required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" id="" placeholder="" autofocus required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Hp</label>
                    <input type="text" name="hp" class="form-control" value="{{ old('hp') }}" id="" placeholder="08..." autofocus required>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    {{--<div class="box" style="margin-top: 5%;">
        <div class="box-header">
            <h2 class="box-title">List Nama Gedung</h2>
        </div>
        <div class="box-body">
            <!-- Select multiple-->
            <div class="form-group">
                <label>ID beserta nama gedung</label>
                <select multiple class="form-control">
                    @foreach($ruangan as $data)
                        <option>{{ $data->id_gedung }} - {{ $data->nama_gedung }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>--}}

@endsection


