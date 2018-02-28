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
    @endif


    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Staff</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('staff.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list staff</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('staff.update', $staff->id_staff ) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama_staff" class="form-control" id="" placeholder="" value="{{ $staff->nama_staff }}">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email_staff" class="form-control" id="" placeholder="" value="{{ $staff->email }}">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="" placeholder="" value="{{ $staff->alamat }}">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Hp</label>
                    <input type="text" name="hp" class="form-control" id="" placeholder="" value="{{ $staff->no_hp }}">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection