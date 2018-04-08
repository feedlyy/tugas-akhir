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
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Prodi</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('prodi.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list prodi</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('prodi.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                {{--kalau fakultas yang login--}}
                @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
                \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
                \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID prodi</label>
                        <input type="text" name="id_prodi" class="form-control" id="" placeholder="" value="{{ old('id_prodi') }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="" placeholder="" value="{{ old('nama_prodi') }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>ID Departemen</label>
                        <select class="form-control" style="width: 100%;" name="selectdepartemen">
                            <option disabled selected="selected">Pilih Departemen</option>
                            @foreach($departemen as $data)
                                <option value="{{ $data->id_departemen }}">{{ $data->nama_departemen }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--kalau yang login departemen--}}
                @else
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID prodi</label>
                        <input type="text" name="id_prodi" class="form-control" id="" placeholder="" value="{{ old('id_prodi') }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="" placeholder="" value="{{ old('nama_prodi') }}" autofocus required>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection