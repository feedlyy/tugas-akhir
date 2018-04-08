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
            <h3 class="box-title">Tambah Departemen</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('departemen.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list departemen</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('departemen.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID Departemen</label>
                    <input type="text" name="id_departemen" class="form-control" id="" placeholder="" value="{{ old('id_departemen') }}" autofocus required>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Departemen</label>
                    <input type="text" name="nama_departemen" class="form-control" id="" placeholder="" value="{{ old('nama_departemen') }}" autofocus required>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection