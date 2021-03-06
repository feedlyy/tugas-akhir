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
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Admin</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('admin.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list admin</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.update', $admin->id_admin) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <h4>Ganti Password</h4>
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Password Baru</label>
                    <input type="password" name="password_baru" class="form-control" id="" placeholder="" value="">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Konfirmasi Password Baru</label>
                    <input type="password" name="konfirm_password" class="form-control" id="" placeholder="" value="">
                </div>
            </div>
            {{--<div class="box-body">
                <label>ID Status</label>
                <select class="form-control select2" style="width: 100%;" name="selectstatus">
                    @foreach($status as $data)
                        <option selected="selected" value="{{ $admin->id_status }}">{{ $data->nama_status }}</option>
                    @endforeach
                </select>
            </div>--}}
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection